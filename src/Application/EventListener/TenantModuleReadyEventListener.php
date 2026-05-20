<?php

namespace App\Application\EventListener;

use App\Application\Provisioning\Message\TenantModuleReadyEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\SerializerStamp;

class TenantModuleReadyEventListener
{
    public function __construct(private MessageBusInterface $messageBus, private LoggerInterface $logger){}
    public function __invoke(TenantModuleReadyEvent $event):void
    {
        $this->logger->debug('Dispatch TenantModuleReadyEvent to RabbitMQ', [
            'subscriptionId' => $event->subscriptionId,
            'subdomain' => $event->subdomain,
            'serviceKey' => $event->serviceKey,
        ]);

        try {
            $this->messageBus->dispatch($event,
                [
                    new AmqpStamp('tenant.ready.' .$event->serviceKey),
                ]
            );
        } catch (ExceptionInterface $e) {
            $this->logger->critical('Error while Dispatch TenantModuleReadyEvent', ["exception" => $e->getMessage()]);
        }
    }
}
