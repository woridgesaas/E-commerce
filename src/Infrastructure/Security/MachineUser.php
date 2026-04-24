<?php

namespace App\Infrastructure\Security;

use Symfony\Component\Security\Core\User\UserInterface;

readonly class MachineUser implements UserInterface
{
    public function __construct(private string $identifier, private array $roles = [])
    {}
    public function getRoles(): array
    {
        return array_unique(array_merge($this->roles, ['ROLE_INTERNAL_MACHINE']));
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->identifier;
    }
}
