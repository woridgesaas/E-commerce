<?php

namespace App\Domain\Provisioning\Exception;

class SubscriptionNotFoundException extends \DomainException
{
    public function __construct(string $message='Subscription not found')
    {
        parent::__construct($message);
    }
}
