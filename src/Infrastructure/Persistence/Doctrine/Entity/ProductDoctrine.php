<?php

namespace App\Infrastructure\Persistence\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'products')]
class ProductDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(length: 50)]
    private string $status;

    #[ORM\Column(length: 50)]
    private string $type;

    #[ORM\Column(type: 'float')]
    private float $price;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $image = null;

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getDescription(): string { return $this->description; }
    public function getStatus(): string { return $this->status; }
    public function getType(): string { return $this->type; }
    public function getPrice(): float { return $this->price; }
    public function getImage(): ?string { return $this->image; }

    public function setName(string $v): void { $this->name = $v; }
    public function setDescription(string $v): void { $this->description = $v; }
    public function setStatus(string $v): void { $this->status = $v; }
    public function setType(string $v): void { $this->type = $v; }
    public function setPrice(float $v): void { $this->price = $v; }
    public function setImage(?string $v): void { $this->image = $v; }
}