<?php

namespace App\Application\Tenant\Service;

use App\Application\Tenant\DTO\TenantAccountVerifyResponse;
use App\Application\Tenant\Message\ActivateCeoAccountEvent;
use App\Application\User\Port\MailerPort;
use App\Domain\Provisioning\Exception\SubscriptionNotFoundException;
use App\Domain\Tenant\Entity\ActivationToken;
use App\Domain\Tenant\Entity\Tenant;
use App\Domain\Tenant\Exception\TokenInvalidException;
use App\Domain\Tenant\Repository\ActivationTokenRepositoryInterface;
use App\Domain\Tenant\Repository\TenantRepositoryInterface;
use App\Domain\Tenant\Service\ActivationGenerator;
use App\Domain\Tenant\ValueObject\Subdomain;
use App\Domain\Tenant\ValueObject\TokenValue;
use App\Domain\User\Entity\User;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Security\Core\Exception\TokenNotFoundException;

class WelcomeTenantService
{
    public function  __construct(
        private MailerPort $mailerPort ,
        private ActivationGenerator $tokenGenerator ,
        private ActivationTokenRepositoryInterface $repository,
        private readonly TenantRepositoryInterface $tenantRepository,
        private readonly MessageBusInterface $messageBus,
        private LoggerInterface $logger
    )
    {

    }
    public function execute(User $ceo , string $subdomain):void{
        $subdomain = new Subdomain($subdomain);
        //get the subscription registry first :
        /** @var Tenant $subscription */
        $subscription = $this->tenantRepository->findBySubdomain($subdomain);
        if(!$subscription)
            throw new SubscriptionNotFoundException();

        $tokenVO = $this->tokenGenerator->generateNewToken();
        $subscription->addActivationToken($tokenVO);

        $this->tenantRepository->save($subscription);
        $this->mailerPort->sendWelcomeActivation(
            $ceo,
            $tokenVO->getValue(),
            $subdomain->getValue(),
        );
    }

    public function checkToken(string $token):TenantAccountVerifyResponse{
        $valueObject = new TokenValue($token);
        /** @var ActivationToken $token */
        $token = $this->repository->findByValue($valueObject);

        if (!$token) {
            throw new TokenNotFoundException("Provided token does not exist");
        }
        if ($token->isExpired() || $token->isUsed()) {
            throw new TokenInvalidException("This activation token is invalid");
        }
        /** @var Tenant $subscription */
        $subscription = $token->getSubscription();
        /** @var User $ceo */
        $ceo = $subscription->getCeo();

        return new TenantAccountVerifyResponse(
          email: $ceo->getEmail()->value(),
          firstName: $ceo->getFirstName()->value(),
          lastName: $ceo->getLastName()->value(),
          companyName: $subscription->getCompanyName(),
          subdomain: $subscription->getSubdomain()->getValue(),
        );
    }

    /**
     * @throws ExceptionInterface
     */
    public function confirmActivation(string $token , string $plainPassword):void{
        /** @var ActivationToken $tokenDomain */
        $tokenDomain = $this->repository->findByValue(new TokenValue($token));
        if(!$tokenDomain || $tokenDomain->isExpired() || $tokenDomain->isUsed())
            throw new  TokenInvalidException("This activation token is invalid");

        /** @var Tenant $tenant */
        $tenant = $tokenDomain->getSubscription();
        $ceo = $tenant->getCeo();

        $hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);
        $message = new ActivateCeoAccountEvent(
            firstName: $ceo->getFirstName()->value(),
            lastName: $ceo->getLastName()->value(),
            email: $ceo->getEmail()->value(),
            password: $hashedPassword,
            role: 'CEO',
            subdomain: $tenant->getSubdomain()->getValue(),
            cin: "AB123456",
            phoneNumber: "0600000000",
            departmentId: "550e8400-e29b-41d4-a716-446655440000",
            postId: "660e8400-e29b-41d4-a716-446655440011"
        );
        $this->logger->notice("Dispatching activation account event to other services ..." ,[
            'message' => $message,
        ]);
        $this->messageBus->dispatch($message);

        $tokenDomain->setUsed(true);
        $this->repository->save($tokenDomain);
    }
}
