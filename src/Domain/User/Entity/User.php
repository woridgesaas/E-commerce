<?php

namespace App\Domain\User\Entity;

use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\UserName;

final class User
{
    private ?int $id = null;

    // Reset password fields live in the domain
    private ?string $resetToken = null;
    private ?\DateTimeImmutable $resetTokenExpiresAt = null;

    public function __construct(
        private UserName $firstName,
        private UserName $lastName,
        private Email    $email,
        private string   $password,
        private string   $role = 'ROLE_USER'
    ) {}

    public static function reconstitute(
        ?int              $id,
        UserName          $firstName,
        UserName          $lastName,
        Email             $email,
        string            $password,
        string            $role,
        ?string           $resetToken = null,
        ?\DateTimeImmutable $resetTokenExpiresAt = null
    ): self {
        $user                      = new self($firstName, $lastName, $email, $password, $role);
        $user->id                  = $id;
        $user->resetToken          = $resetToken;
        $user->resetTokenExpiresAt = $resetTokenExpiresAt;
        return $user;
    }

    // --- Getters ---
    public function getId(): ?int                         { return $this->id; }
    public function getFirstName(): UserName              { return $this->firstName; }
    public function getLastName(): UserName               { return $this->lastName; }
    public function getEmail(): Email                     { return $this->email; }
    public function getPassword(): string                 { return $this->password; }
    public function getRole(): string                     { return $this->role; }
    public function getResetToken(): ?string              { return $this->resetToken; }
    public function getResetTokenExpiresAt(): ?\DateTimeImmutable { return $this->resetTokenExpiresAt; }

    // --- Domain behaviour ---

    public function changePassword(string $hashedPassword): void
    {
        $this->password = $hashedPassword;
    }

    public function requestPasswordReset(string $token, \DateTimeImmutable $expiresAt): void
    {
        $this->resetToken          = $token;
        $this->resetTokenExpiresAt = $expiresAt;
    }

    public function clearResetToken(): void
    {
        $this->resetToken          = null;
        $this->resetTokenExpiresAt = null;
    }

    public function isResetTokenExpired(): bool
    {
        if ($this->resetTokenExpiresAt === null) {
            return true;
        }
        return $this->resetTokenExpiresAt < new \DateTimeImmutable();
    }
}