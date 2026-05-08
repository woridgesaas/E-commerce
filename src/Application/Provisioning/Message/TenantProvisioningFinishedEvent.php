<?php

namespace App\Application\Provisioning\Message;

class TenantProvisioningFinishedEvent
{
    public function __construct(public int $subscriptionId){}
}
