<?php

namespace App\Infrastructure\Persistence\Doctrine\Mapper;

use App\Domain\Product\Entity\Product;
use App\Domain\Product\ValueObject\ProductStatus;
use App\Domain\Product\ValueObject\ProductType;
use App\Infrastructure\Persistence\Doctrine\Entity\ProductDoctrine;

final class ProductMapper
{
    public function toDomain(ProductDoctrine $entity): Product
    {
        return Product::reconstitute(
            id:          $entity->getId(),
            name:        $entity->getName(),
            description: $entity->getDescription(),
            status:      ProductStatus::from($entity->getStatus()),
            type:        ProductType::from($entity->getType()),
            price:       $entity->getPrice(),
            image:       $entity->getImage()
        );
    }

    public function toDoctrine(Product $product): ProductDoctrine
    {
        $entity = new ProductDoctrine();
        $this->fill($product, $entity);
        return $entity;
    }

    public function fill(Product $product, ProductDoctrine $entity): void
    {
        $entity->setName($product->getName());
        $entity->setDescription($product->getDescription());
        $entity->setStatus($product->getStatus()->value);
        $entity->setType($product->getType()->value);
        $entity->setPrice($product->getPrice());
        $entity->setImage($product->getImage());
    }
}