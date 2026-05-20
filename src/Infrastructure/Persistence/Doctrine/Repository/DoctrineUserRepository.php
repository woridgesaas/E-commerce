<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\Email;
use App\Infrastructure\Persistence\Doctrine\Entity\UserDoctrine;
use App\Infrastructure\Persistence\Doctrine\Mapper\UserMapper;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineUserRepository implements UserRepositoryInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly UserMapper             $mapper
    ) {}

    public function save(User $user): void
    {
        $existing = null;

        if ($user->getId() !== null) {
            $existing = $this->em->getRepository(UserDoctrine::class)->find($user->getId());
        }

        if ($existing === null) {
            $doctrineUser = $this->mapper->toDoctrine($user);
            $this->em->persist($doctrineUser);
        } else {
            $this->mapper->fillDoctrineFromDomain($user, $existing);
        }

        $this->em->flush();
    }

    public function findByEmail(Email $email): ?User
    {
        $entity = $this->em
            ->getRepository(UserDoctrine::class)
            ->findOneBy(['email' => $email->value()]);

        return $entity ? $this->mapper->toDomain($entity) : null;
    }

    public function findById(int $id): ?User
    {
        $entity = $this->em->getRepository(UserDoctrine::class)->find($id);
        return $entity ? $this->mapper->toDomain($entity) : null;
    }

    public function findByResetToken(string $token): ?User
    {
        // FIX: was calling $this->mapToDomain() which doesn't exist
        $entity = $this->em
            ->getRepository(UserDoctrine::class)
            ->findOneBy(['resetToken' => $token]);

        return $entity ? $this->mapper->toDomain($entity) : null;
    }
}