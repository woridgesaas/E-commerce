<?php

namespace App\Application\User\Service;

use App\Application\User\Port\PasswordHasherInterface;
use App\Domain\User\Repository\UserRepositoryInterface;

final class ResetPasswordService
{
    public function __construct(
        private UserRepositoryInterface $repo,
        private PasswordHasherInterface $hasher
    ) {}

    public function execute(string $token, string $newPassword): void
    {
        $user = $this->repo->findByResetToken($token);

        if ($user === null || $user->isResetTokenExpired()) {
            throw new \DomainException('Lien invalide ou expiré.');
        }

        $user->changePassword($this->hasher->hash($newPassword));
        $user->clearResetToken();

        $this->repo->save($user);
    }
}