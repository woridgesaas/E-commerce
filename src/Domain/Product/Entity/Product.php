<?php

namespace App\Domain\Product\Entity;

use App\Domain\Product\Exception\InvalidPriceException;
use App\Domain\Product\Exception\InvalidProductNameException;
use App\Domain\Product\Exception\InvalidProductDescriptionException;
use App\Domain\Product\ValueObject\ProductStatus;
use App\Domain\Product\ValueObject\ProductType;

final class Product
{
    private ?int $id = null;

    private string $name;
    private string $description;
    private ProductStatus $status;
    private ProductType $type;
    private float $price;
    private ?string $image;

    public function __construct(
        string $name,
        string $description,
        ProductStatus $status,
        ProductType $type,
        float $price,
        ?string $image = null
    ) {
        if (trim($name) === '') {
            throw InvalidProductNameException::becauseEmpty();
        }

        if (trim($description) === '') {
            throw InvalidProductDescriptionException::becauseEmpty();
        }

        if ($price <= 0) {
            throw InvalidPriceException::becauseNegativeOrZero($price);
        }

        $this->name        = trim($name);
        $this->description = trim($description);
        $this->status      = $status;
        $this->type        = $type;
        $this->price       = $price;
        $this->image       = $image;
    }

    public static function reconstitute(
        ?int $id,
        string $name,
        string $description,
        ProductStatus $status,
        ProductType $type,
        float $price,
        ?string $image = null
    ): self {
        $p = new self($name, $description, $status, $type, $price, $image);
        $p->id = $id;
        return $p;
    }

    public function update(
        string $name,
        string $description,
        ProductType $type,
        float $price,
        ?string $image = null
    ): void {
        if (trim($name) === '') {
            throw InvalidProductNameException::becauseEmpty();
        }

        if (trim($description) === '') {
            throw InvalidProductDescriptionException::becauseEmpty();
        }

        if ($price <= 0) {
            throw InvalidPriceException::becauseNegativeOrZero($price);
        }

        $this->name        = trim($name);
        $this->description = trim($description);
        $this->type        = $type;
        $this->price       = $price;

        if ($image !== null) {
            $this->image = $image;
        }
    }

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getDescription(): string { return $this->description; }
    public function getStatus(): ProductStatus { return $this->status; }
    public function getType(): ProductType { return $this->type; }
    public function getPrice(): float { return $this->price; }
    public function getImage(): ?string { return $this->image; }
}