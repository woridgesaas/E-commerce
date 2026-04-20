<?php

namespace App\Infrastructure\Security;

use App\Application\User\Port\PasswordHasherInterface;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;  // ← manquait

final class SymfonyPasswordHasher implements PasswordHasherInterface
{
    private readonly \Symfony\Component\PasswordHasher\PasswordHasherInterface $hasher;

    public function __construct()
    {
        $factory = new PasswordHasherFactory([
            'common' => ['algorithm' => 'bcrypt', 'cost' => 13],
        ]);

        $this->hasher = $factory->getPasswordHasher('common');
    }

    public function hash(string $plainPassword): string
    {
        return $this->hasher->hash($plainPassword);
    }

    public function verify(string $hashedPassword, string $plainPassword): bool
    {
        return $this->hasher->verify($hashedPassword, $plainPassword);
    }
}