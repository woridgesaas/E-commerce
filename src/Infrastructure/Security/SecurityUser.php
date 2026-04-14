<?php

namespace App\Infrastructure\Security;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class SecurityUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    public function __construct(
        private readonly string $email,
        private readonly string $password,
        private readonly array  $roles
    ) {}

    public function getUserIdentifier(): string { return $this->email; }

    public function getPassword(): string { return $this->password; }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER'; // toujours présent
        return array_unique($roles);
    }

    public function eraseCredentials(): void {}
}