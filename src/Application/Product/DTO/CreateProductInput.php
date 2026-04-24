<?php 
namespace App\Application\Product\DTO;
use App\Domain\Product\ValueObject\ProductType;
final readonly class CreateProductInput
{
    public function __construct(
        #[Assert\NotBlank(message: 'Le nom est obligatoire.')]
        #[Assert\Length(min: 2, max: 255, minMessage: 'Minimum {{ limit }} caractères.')]
        public string $name,

        #[Assert\NotBlank(message: 'La description est obligatoire.')]
        public string $description,

        public ProductType $type,

        #[Assert\Positive(message: 'Le prix doit être positif.')]
        public float $price,

        public ?string $image = null
    ) {}
}