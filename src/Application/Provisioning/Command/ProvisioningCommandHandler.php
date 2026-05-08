<?php

namespace App\Application\Provisioning\Command;

use App\Application\Provisioning\Message\TenantModuleReadyEvent;
use App\Application\Provisioning\Message\TenantProvisioningFinishedEvent;
use App\Domain\Provisioning\DatabaseConfigFactoryInterface;
use App\Domain\Provisioning\Exception\SubscriptionNotFoundException;
use App\Domain\Provisioning\Service\DatabaseProvisionerInterface;
use App\Domain\Tenant\ValueObject\Subdomain;
use App\Domain\Tenant\Repository\TenantRepositoryInterface;
use App\Infrastructure\Persistence\Doctrine\Entity\SubscriptionRegistryDoctrine;
use App\Infrastructure\Provisioning\Resolver\DatabaseProvisionerGuesser;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;


#[AsMessageHandler]
class ProvisioningCommandHandler
{
    public function __construct(
        private TenantRepositoryInterface $subscriptionRepository,
        private DatabaseProvisionerGuesser $databaseProvisionerGuesser,
        private DatabaseConfigFactoryInterface $databaseConfigFactory,
        private EventDispatcherInterface $eventDispatcher
    ) {}

    public function __invoke(ProvisioningCommand $command): void{
        /** @var  SubscriptionRegistryDoctrine $subscription*/
        $subscription = $this->subscriptionRepository->find($command->subscriptionId);
        if(!$subscription)
            throw new SubscriptionNotFoundException("Subscription width id ". $command->subscriptionId ." not found");
        $product = $subscription->getProduct();

        $subdomain=  new Subdomain($subscription->getSubdomain());
        foreach ($product->getModules() as $module) {
            echo "Module : " . $module->getName() . "\n";
            $config = $this->databaseConfigFactory->createFromModule($module->getServiceKey() ,$subdomain );
            /** @var DatabaseProvisionerInterface|null $provisioner */
            $provisioner = $this->databaseProvisionerGuesser->get($config->getServerType());
            $provisioner->createDatabase($config);

            /** Inform microservice that the module is ready */
            $this->eventDispatcher->dispatch(
                new TenantModuleReadyEvent(
                    subscriptionId: $command->subscriptionId,
                    subdomain: $subdomain->getValue(),
                    serviceKey: $module->getServiceKey(),
                )
            );
        }

        /** provisioning finished now we will send account activation mail to ceo :) */
        $this->eventDispatcher->dispatch(
            new TenantProvisioningFinishedEvent($command->subscriptionId)
        );
    }
}
