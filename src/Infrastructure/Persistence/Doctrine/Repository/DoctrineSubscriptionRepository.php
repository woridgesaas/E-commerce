<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Subscription\Repository\SubscriptionRepositoryInterface;
use App\Domain\Subscription\Entity\Subscription;
use App\Domain\Subscription\Enum\SubscriptionType;
use App\Infrastructure\Persistence\Doctrine\Entity\SubscriptionDoctrine;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineSubscriptionRepository implements SubscriptionRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function findAll(): array
    {
        $entities = $this->em
            ->getRepository(SubscriptionDoctrine::class)
            ->findAll();

        return array_map([$this, 'mapToDomain'], $entities);
    }

    public function findById(int $id): ?Subscription
    {
        $entity = $this->em
            ->getRepository(SubscriptionDoctrine::class)
            ->find($id);

        return $entity ? $this->mapToDomain($entity) : null;
    }

    public function findByType(string $type): array
    {
        $entities = $this->em
            ->getRepository(SubscriptionDoctrine::class)
            ->findBy(['type' => $type]);

        return array_map([$this, 'mapToDomain'], $entities);
    }

    private function mapToDomain(SubscriptionDoctrine $entity): Subscription
    {
        return new Subscription(
            $entity->getId(),
            $entity->getType(),
            $entity->getDurationInMonths(),
            $entity->getPrice()
        );
    }
}