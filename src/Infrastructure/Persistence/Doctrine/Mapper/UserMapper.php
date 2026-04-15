<?php

namespace App\Infrastructure\Persistence\Doctrine\Mapper;

use App\Domain\User\Entity\User;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\UserName;
use App\Infrastructure\Persistence\Doctrine\Entity\UserDoctrine;

class UserMapper
{
    public function toDomain(UserDoctrine $entity): User
    {
        return User::reconstitute(
            id:                  $entity->getId(),
            firstName:           new UserName($entity->getFirstName()),
            lastName:            new UserName($entity->getLastName()),
            email:               new Email($entity->getEmail()),
            password:            $entity->getPassword(),
            role:                $entity->getRole(),
            resetToken:          $entity->getResetToken(),
            resetTokenExpiresAt: $entity->getResetTokenExpiresAt()
        );
    }

    public function toDoctrine(User $user): UserDoctrine
    {
        $entity = new UserDoctrine();
        $this->fillDoctrineFromDomain($user, $entity);
        return $entity;
    }

    public function fillDoctrineFromDomain(User $user, UserDoctrine $entity): void
    {
        $entity->setFirstName($user->getFirstName()->value());
        $entity->setLastName($user->getLastName()->value());
        $entity->setEmail($user->getEmail()->value());
        $entity->setPassword($user->getPassword());
        $entity->setRole($user->getRole());
        $entity->setResetToken($user->getResetToken());
        $entity->setResetTokenExpiresAt($user->getResetTokenExpiresAt());
    }
}