<?php

namespace App\Infrastructure\Persistence\Doctrine\Mapper;

use App\Domain\Tenant\Entity\Tenant;
use App\Domain\Tenant\Enum\TenantStatus;
use App\Domain\Tenant\ValueObject\Subdomain;
use App\Infrastructure\Persistence\Doctrine\Entity\SubscriptionRegistryDoctrine;

class TenantMapper
{
    public function toDomain(SubscriptionRegistryDoctrine $persistence): Tenant
    {
        return new Tenant(
            new Subdomain($persistence->getSubdomain()),
            $persistence->getEndDate(),
            TenantStatus::from($persistence->getStatus()),

        );
    }
}
