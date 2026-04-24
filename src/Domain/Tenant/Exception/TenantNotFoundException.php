<?php

namespace App\Domain\Tenant\Exception;

class TenantNotFoundException extends \DomainException
{
    public function __construct(string $message='Tenant not found')
    {
        parent::__construct($message);
    }
}
