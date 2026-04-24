<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Tenant\Entity\Tenant;
use App\Domain\Tenant\Repository\TenantRepositoryInterface;
use App\Domain\Tenant\ValueObject\Subdomain;
use App\Infrastructure\Persistence\Doctrine\Entity\SubscriptionRegistryDoctrine;
use App\Infrastructure\Persistence\Doctrine\Mapper\TenantMapper;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineTenantRepository implements TenantRepositoryInterface
{

    public function __construct(
        private EntityManagerInterface $entityManager,
        private TenantMapper $mapper
    ){}
    public function findBySubdomain(Subdomain $subdomain): ?Tenant
    {
        $persistence = $this->entityManager->getRepository(SubscriptionRegistryDoctrine::class)
            ->findOneBy(['subdomain' => $subdomain->getValue()]);

        if(!$persistence) {
            return null;
        }
        return $this->mapper->toDomain($persistence);
    }
}
