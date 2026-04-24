<?php

namespace App\Application\User\Service;

use App\Application\User\Port\PasswordHasherInterface;
use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\UserName;
use App\Domain\User\ValueObject\UserRole;

final class CreateUserService
{
    public function __construct(
        private UserRepositoryInterface $repo,
        private PasswordHasherInterface $hasher
    ) {}

    public function execute(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        UserRole $role 
    ): void {

        $user = new User(
            new UserName($firstName),
            new UserName($lastName),
            new Email($email),
            $this->hasher->hash($password),
            $role->value
        );

        $this->repo->save($user);
    }
}