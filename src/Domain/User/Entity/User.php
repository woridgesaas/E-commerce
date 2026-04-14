<?php

namespace App\Domain\User\Entity;

use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\UserName;

final class User
{
    private ?int $id = null;

    public function __construct(
        private UserName $firstName,
        private UserName $lastName,
        private Email    $email,
        private string   $password,
        private string   $role = 'ROLE_USER'
    ) {}

    public static function reconstitute(
        ?int     $id,
        UserName $firstName,
        UserName $lastName,
        Email    $email,
        string   $password,
        string   $role
    ): self {
        $user = new self($firstName, $lastName, $email, $password, $role);
        $user->id = $id;
        return $user;
    }

    public function getId(): ?int          { return $this->id; }
    public function getFirstName(): UserName { return $this->firstName; }
    public function getLastName(): UserName  { return $this->lastName; }
    public function getEmail(): Email      { return $this->email; }
    public function getPassword(): string  { return $this->password; }
    public function getRole(): string      { return $this->role; }
}