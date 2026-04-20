<?php
// src/Domain/Product/Entity/Product.php
namespace App\Domain\Product\Entity;

use App\Domain\Product\Exception\InvalidPriceException;
use App\Domain\Product\ValueObject\ProductStatus;
use App\Domain\Product\ValueObject\ProductType;

final class Product
{
    private ?int $id = null;

    public function __construct(
        private string      $name,
        private string      $description,
        private ProductStatus $status,
        private ProductType $type,
        private float       $price,
        private ?string     $image = null
    ) {}

    public static function reconstitute(
        ?int          $id,
        string        $name,
        string        $description,
        ProductStatus $status,
        ProductType   $type,
        float         $price,
        ?string       $image = null
    ): self {
        $p     = new self($name, $description, $status, $type, $price, $image);
        $p->id = $id;
        return $p;
    }

    public function update(
        string      $name,
        string      $description,
        ProductType $type,
        float       $price,
        ?string     $image = null
    ): void {
        $this->name        = $name;
        $this->description = $description;
        $this->type        = $type;
        $this->price       = $price;
        if ($image !== null) {
            $this->image = $image;
        }
    }

    public function getId(): ?int           { return $this->id; }
    public function getName(): string       { return $this->name; }
    public function getDescription(): string { return $this->description; }
    public function getStatus(): ProductStatus { return $this->status; }
    public function getType(): ProductType  { return $this->type; }
    public function getPrice(): float       { return $this->price; }
    public function getImage(): ?string     { return $this->image; }

    public function changePrice(float $price): void
    {
        if ($price <= 0) {
            throw InvalidPriceException::becauseNegativeOrZero($price);
        }
        $this->price = $price;
    }

    public function activate(): void   { $this->status = ProductStatus::Active; }
    public function deactivate(): void { $this->status = ProductStatus::Inactive; }
}