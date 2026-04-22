<?php
namespace App\Domain\Product\Repository;

use App\Domain\Product\Entity\Product;

interface ProductRepositoryInterface
{
    public function save(Product $product): void;
    public function findAll(): array;
    public function findById(int $id): ?Product;
    public function delete(Product $product): void;
    public function findLatest(int $limit): array;
}