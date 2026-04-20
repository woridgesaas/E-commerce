<?php
namespace App\Application\Product\DTO;

use App\Domain\Product\ValueObject\ProductType;

final readonly class UpdateProductInput
{
    public function __construct(
        public int         $id,
        public string      $name,
        public string      $description,
        public ProductType $type,
        public float       $price,
        public ?string     $image = null
    ) {}
}