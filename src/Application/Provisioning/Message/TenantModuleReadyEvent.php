<?php

namespace App\Application\Provisioning\Message;

readonly class TenantModuleReadyEvent
{
    public function __construct(
        public int $subscriptionId,
        public string $subdomain,
        public string $serviceKey
    ) {}
}
