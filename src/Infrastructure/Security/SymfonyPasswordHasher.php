<?php

namespace App\Infrastructure\Security;

use App\Application\User\Port\PasswordHasherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SymfonyPasswordHasher implements PasswordHasherInterface
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher
    ) {}

    public function hash(string $plainPassword): string
    {
        // On crée un SecurityUser temporaire pour satisfaire l'interface
        $user = new SecurityUser('', '', []);
        return $this->hasher->hashPassword($user, $plainPassword);
    }

    public function verify(string $hashedPassword, string $plainPassword): bool
    {
        $user = new SecurityUser('', $hashedPassword, []);
        return $this->hasher->isPasswordValid($user, $plainPassword);
    }
}