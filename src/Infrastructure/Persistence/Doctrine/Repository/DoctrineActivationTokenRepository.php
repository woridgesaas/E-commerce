<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Tenant\Entity\ActivationToken;
use App\Domain\Tenant\Repository\ActivationTokenRepositoryInterface;
use App\Domain\Tenant\ValueObject\TokenValue;
use App\Infrastructure\Persistence\Doctrine\Entity\ActivationTokenDoctrine;
use App\Infrastructure\Persistence\Doctrine\Mapper\ActivationTokenMapper;
use App\Infrastructure\Persistence\Doctrine\Mapper\TenantMapper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;

class DoctrineActivationTokenRepository implements ActivationTokenRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager , private TenantMapper $mapper , private ActivationTokenMapper $activationTokenMapper){}
    /**
     * @param TokenValue $value
     * @return ActivationToken
     */
    /**
     * @param TokenValue $value
     * @return ActivationToken|null
     */
    public function findByValue(TokenValue $value): ?ActivationToken
    {
        $persistance = $this->entityManager
            ->getRepository(ActivationTokenDoctrine::class)
            ->findOneBy(['value' => $value->getValue()]);
        if(!$persistance)
            return null;
        return $this->mapper
            ->toActivationDomain($persistance);
    }

    /**
     * @throws ORMException
     */
    public function save(ActivationToken $activationToken): void{
        $existing = $this->activationTokenMapper->toActivationDoctrine($activationToken);
        if ($existing) {
            $existing->setExpireAt($activationToken->getExpiresAt());
            $existing->setUsed($activationToken->isUsed());
        } else {

            $doctrineEntity = $this->activationTokenMapper->toActivationDoctrine($activationToken);
            $this->entityManager->persist($doctrineEntity);
        }
        $this->entityManager->flush();
    }
}
