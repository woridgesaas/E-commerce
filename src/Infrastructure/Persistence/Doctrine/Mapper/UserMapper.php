<?php

namespace App\Infrastructure\Persistence\Doctrine\Mapper;

use App\Domain\User\Entity\User;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\UserName;
use App\Infrastructure\Persistence\Doctrine\Entity\UserDoctrine;

class UserMapper
{
    public function toDomain(UserDoctrine $e): User
    {
        return User::reconstitute(
            $e->getId(),
            new UserName($e->getFirstName()),
            new UserName($e->getLastName()),
            new Email($e->getEmail()),
            $e->getPassword(),
            $e->getRole()
        );
    }

    public function toDoctrine(User $user): UserDoctrine
    {
        $e = new UserDoctrine();
        $this->fillDoctrineFromDomain($user, $e);
        return $e;
    }

    public function fillDoctrineFromDomain(User $user, UserDoctrine $e): void
    {
        $e->setFirstName($user->getFirstName()->value());
        $e->setLastName($user->getLastName()->value());
        $e->setEmail($user->getEmail()->value());
        $e->setPassword($user->getPassword());
        $e->setRole($user->getRole());
    }
}