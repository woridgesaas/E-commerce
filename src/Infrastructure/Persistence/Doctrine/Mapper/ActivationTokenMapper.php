<?php

namespace App\Infrastructure\Persistence\Doctrine\Mapper;

use App\Domain\Tenant\Entity\ActivationToken;
use App\Infrastructure\Persistence\Doctrine\Entity\ActivationTokenDoctrine;
use App\Infrastructure\Persistence\Doctrine\Entity\SubscriptionRegistryDoctrine;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;

class ActivationTokenMapper
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    /**
     * @throws ORMException
     */
    public function toActivationDoctrine(ActivationToken $token): ActivationTokenDoctrine
    {

        $existing = $this->entityManager
            ->getRepository(ActivationTokenDoctrine::class)
            ->findOneBy(['value' => $token->getValue()->getValue()]);

        if ($existing) {

            $existing->setUsed($token->isUsed());
            $existing->setExpireAt($token->getExpiresAt());
            return $existing;
        }
        $subscriptionPersistence = $this->entityManager
            ->getRepository(SubscriptionRegistryDoctrine::class)
            ->findOneBy(['subdomain' => $token->getSubscription()->getSubdomain()->getValue()]);

        $doctrineEntity = new ActivationTokenDoctrine(
            $token->getValue()->getValue(),
            $token->getExpiresAt(),
            $subscriptionPersistence
        );
        $doctrineEntity->setUsed($token->isUsed());

        return $doctrineEntity;
    }
}
