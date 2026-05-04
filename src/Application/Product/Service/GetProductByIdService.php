<?php
namespace App\Application\Product\Service;

use App\Domain\Product\Entity\Product;
use App\Domain\Product\Exception\ProductNotFoundException;
use App\Domain\Product\Repository\ProductRepositoryInterface;

// Application/Product/Service/GetProductByIdService.php
final class GetProductByIdService
{
    public function __construct(
        private ProductRepositoryInterface $repo
    ) {}

    public function execute(int $id): Product
    {
        $product = $this->repo->findById($id);

        if (!$product) {
            throw ProductNotFoundException::withId($id);
        }

        return $product;
    }
}