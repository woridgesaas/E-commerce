<?php

namespace App\Domain\Provisioning;
use App\Domain\Tenant\ValueObject\Subdomain;
use App\Domain\Provisioning\ValueObject\DatabaseConfig;

interface DatabaseConfigFactoryInterface
{
    public function createFromModule(string $serviceKey, Subdomain $subdomain): DatabaseConfig|null;
}
