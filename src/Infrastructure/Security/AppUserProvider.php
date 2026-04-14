<?php

namespace App\Infrastructure\Security;

use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\Email;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class AppUserProvider implements UserProviderInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $repo
    ) {}

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->repo->findByEmail(new Email($identifier));

        if ($user === null) {
            throw new UserNotFoundException(
                sprintf('Utilisateur "%s" introuvable.', $identifier)
            );
        }

        return new SecurityUser(
            $user->getEmail()->value(),
            $user->getPassword(),
            [$user->getRole()]
        );
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->loadUserByIdentifier($user->getUserIdentifier());
    }

    public function supportsClass(string $class): bool
    {
        return $class === SecurityUser::class;
    }
}