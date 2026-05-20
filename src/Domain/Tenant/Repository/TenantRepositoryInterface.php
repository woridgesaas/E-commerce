<?php

namespace App\Domain\Tenant\Repository;

use App\Domain\Tenant\Entity\Tenant;
use App\Domain\Tenant\ValueObject\Subdomain;

interface TenantRepositoryInterface
{
    public function  findBySubdomain(Subdomain $subdomain): ?Tenant;
    public function save(Tenant $tenant): void;
}
