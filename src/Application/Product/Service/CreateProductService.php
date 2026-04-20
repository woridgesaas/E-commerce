<?php
// src/Application/Product/Service/CreateProductService.php
namespace App\Application\Product\Service;

use App\Application\Product\DTO\CreateProductInput;
use App\Domain\Product\Entity\Product;
use App\Domain\Product\Repository\ProductRepositoryInterface;
use App\Domain\Product\ValueObject\ProductStatus;

final class CreateProductService
{
    public function __construct(
        private readonly ProductRepositoryInterface $repo
    ) {}

    public function execute(CreateProductInput $input): void
    {
        $product = new Product(
            $input->name,
            $input->description,
            ProductStatus::Active,
            $input->type,
            $input->price,
            $input->image
        );

        $this->repo->save($product);
    }
}