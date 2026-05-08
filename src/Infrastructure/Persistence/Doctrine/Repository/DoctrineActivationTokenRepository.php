<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Tenant\Entity\ActivationToken;
use App\Domain\Tenant\Repository\ActivationTokenRepositoryInterface;
use App\Domain\Tenant\ValueObject\TokenValue;
use App\Infrastructure\Persistence\Doctrine\Entity\ActivationTokenDoctrine;
use App\Infrastructure\Persistence\Doctrine\Mapper\TenantMapper;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineActivationTokenRepository implements ActivationTokenRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager , private TenantMapper $mapper){}
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
}
