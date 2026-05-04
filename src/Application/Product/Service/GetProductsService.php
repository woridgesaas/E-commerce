<?php

namespace App\Application\Product\Service;

use App\Domain\Product\Repository\ProductRepositoryInterface;

final class GetProductsService
{
    public function __construct(
        private ProductRepositoryInterface $repo
    ) {}

    public function execute(): array
    {
        return $this->repo->findAll();
    }
}