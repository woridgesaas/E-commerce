<?php

namespace App\Application\Tenant\Service;

use App\Application\User\Port\MailerPort;
use App\Domain\Provisioning\Exception\SubscriptionNotFoundException;
use App\Domain\Tenant\Entity\Tenant;
use App\Domain\Tenant\Exception\TokenInvalidException;
use App\Domain\Tenant\Repository\ActivationTokenRepositoryInterface;
use App\Domain\Tenant\Repository\TenantRepositoryInterface;
use App\Domain\Tenant\Service\ActivationGenerator;
use App\Domain\Tenant\ValueObject\Subdomain;
use App\Domain\Tenant\ValueObject\TokenValue;
use App\Domain\User\Entity\User;
use Symfony\Component\Security\Core\Exception\TokenNotFoundException;

class WelcomeTenantService
{
    public function  __construct(
        private MailerPort $mailerPort ,
        private ActivationGenerator $tokenGenerator ,
        private ActivationTokenRepositoryInterface $repository,
        private readonly TenantRepositoryInterface $tenantRepository
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

    public function checkToken(string $token):void{
        $valueObject = new TokenValue($token);
        $token = $this->repository->findByValue($valueObject);

        if (!$token) {
            throw new TokenNotFoundException("Provided token does not exist");
        }
        if ($token->isExpired() || $token->isUsed()) {
            throw new TokenInvalidException("This activation token is invalid");
        }

    }
}
