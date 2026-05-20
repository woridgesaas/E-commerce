<?php

namespace App\Application\Product\Service;

use App\Domain\Product\Repository\ProductRepositoryInterface;

final class GetHomepageProductsService
{
    private const HOMEPAGE_LIMIT = 2;

    public function __construct(
        private readonly ProductRepositoryInterface $repo
    ) {}

    public function execute(): array
{
    $products = $this->repo->findAll();

    shuffle($products); 

    return array_slice($products, 0, 2); 
}
}