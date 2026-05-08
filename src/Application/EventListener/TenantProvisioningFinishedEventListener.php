<?php

namespace App\Application\EventListener;

use App\Application\Provisioning\Message\TenantProvisioningFinishedEvent;
use App\Application\Tenant\Service\WelcomeTenantService;
use App\Domain\Tenant\Repository\TenantRepositoryInterface;
use App\Domain\User\Entity\User;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\UserName;
use App\Infrastructure\Persistence\Doctrine\Entity\SubscriptionRegistryDoctrine;
use Psr\Log\LoggerInterface;

class TenantProvisioningFinishedEventListener
{
    public function __construct(
        private WelcomeTenantService $welcomeTenantService,
        private TenantRepositoryInterface $repository,
        private LoggerInterface $logger
    ) {}
    public  function __invoke(TenantProvisioningFinishedEvent $event): void
    {

        /** @var SubscriptionRegistryDoctrine $subscription */

        $subscription = $this->repository->find($event->subscriptionId);
        $company = $subscription->getCompany();
        $ceo = $company->getCeo();
        $this->logger->info("Dispatch TenantProvisioningFinishedEvent , sending activation account email ....",
            [
                'subscriptionId' => $event->subscriptionId,
                'subdomain' => $subscription->getSubdomain(),
                'tenant' => $ceo->getFirstName(),
                'company' => $company->getCompanyEmail() . " " . $company->getAdresse(),
            ]
        );
        $userDomain = new User(
            firstName: new UserName($ceo->getFirstName()),
            lastName: new UserName($ceo->getLastName()),
            email: new Email($ceo->getEmail()),
            password: ""
        );
        $this->welcomeTenantService->execute($userDomain, $subscription->getSubdomain());
    }
}
