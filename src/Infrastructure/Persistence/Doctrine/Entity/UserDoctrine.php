<?php

namespace App\Infrastructure\Persistence\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class UserDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100, nullable: false)]
    private string $firstName;

    #[ORM\Column(type: 'string', length: 100, nullable: false)]
    private string $lastName;

    #[ORM\Column(type: 'string', length: 150, unique: true, nullable: false)]
    private string $email;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $password;

    #[ORM\Column(type: 'string', length: 50, nullable: false)]
    private string $role = 'ROLE_USER';

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $resetToken = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $resetTokenExpiresAt = null;

    // --- Getters / Setters ---

    public function getId(): ?int              { return $this->id; }

    public function getFirstName(): string     { return $this->firstName; }
    public function setFirstName(string $v): void  { $this->firstName = $v; }

    public function getLastName(): string      { return $this->lastName; }
    public function setLastName(string $v): void   { $this->lastName = $v; }

    public function getEmail(): string         { return $this->email; }
    public function setEmail(string $v): void       { $this->email = $v; }

    public function getPassword(): string      { return $this->password; }
    public function setPassword(string $v): void    { $this->password = $v; }

    public function getRole(): string          { return $this->role; }
    public function setRole(string $v): void        { $this->role = $v; }

    public function getResetToken(): ?string   { return $this->resetToken; }
    public function setResetToken(?string $v): void { $this->resetToken = $v; }

    public function getResetTokenExpiresAt(): ?\DateTimeImmutable { return $this->resetTokenExpiresAt; }
    public function setResetTokenExpiresAt(?\DateTimeImmutable $v): void { $this->resetTokenExpiresAt = $v; }
}