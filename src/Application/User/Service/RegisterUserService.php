<?php

namespace App\Application\User\Service;

use App\Application\User\DTO\RegisterUserInput;
use App\Application\User\Port\PasswordHasherInterface;
use App\Domain\User\Entity\User;
use App\Domain\User\Exception\UserAlreadyExistsException;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\UserName;

final class RegisterUserService
{
    public function __construct(
        private readonly UserRepositoryInterface $repo,
        private readonly PasswordHasherInterface $hasher
    ) {}

    public function execute(RegisterUserInput $input): void
    {
        $email = new Email($input->email);

        if ($this->repo->findByEmail($email) !== null) {
            throw UserAlreadyExistsException::withEmail($input->email);
        }

        $user = new User(
            new UserName($input->firstName),
            new UserName($input->lastName),
            $email,
            $this->hasher->hash($input->password)
        );

        $this->repo->save($user);
    }
}