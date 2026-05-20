<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Tenant\Entity\Tenant;
use App\Domain\Tenant\Repository\TenantRepositoryInterface;
use App\Domain\Tenant\ValueObject\Subdomain;
use App\Infrastructure\Persistence\Doctrine\Entity\SubscriptionRegistryDoctrine;
use App\Infrastructure\Persistence\Doctrine\Mapper\TenantMapper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineTenantRepository  implements TenantRepositoryInterface
{

    public function __construct(
        private EntityManagerInterface $entityManager,
        private TenantMapper           $mapper,
        private ManagerRegistry $doctrine
    )
    {
    }
    public function find(int $id): ?SubscriptionRegistryDoctrine
    {
        $repo = $this->doctrine->getRepository(SubscriptionRegistryDoctrine::class);
        return $repo->find($id);
    }

    public function findBySubdomain(Subdomain $subdomain): ?Tenant
    {
        $persistence = $this->entityManager->getRepository(SubscriptionRegistryDoctrine::class)
            ->findOneBy(['subdomain' => $subdomain->getValue()]);

        if (!$persistence) {
            return null;
        }
        return $this->mapper->toDomain($persistence);
    }

    public function save(Tenant $tenant): void
    {
        $persistence = $this->entityManager
            ->getRepository(SubscriptionRegistryDoctrine::class)
            ->findOneBy(['subdomain' => $tenant->getSubdomain()->getValue()]);
        $this->mapper->mapToPersistence($tenant, $persistence);
        $this->entityManager->persist($persistence);
        $this->entityManager->flush();
    }
}
