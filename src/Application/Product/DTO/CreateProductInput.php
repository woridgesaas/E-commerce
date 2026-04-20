<?php 
namespace App\Application\Product\DTO;
use App\Domain\Product\ValueObject\ProductType;
final readonly class CreateProductInput
{
    public function __construct(
        public string  $name,
        public string  $description,
        public ProductType   $type,
        public float   $price,
        public ?string $image = null    
    ) {}
}