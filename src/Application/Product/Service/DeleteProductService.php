<?php
namespace App\Application\Product\Service;
use App\Domain\Product\Repository\ProductRepositoryInterface;


final class DeleteProductService
{
    public function __construct(
        private readonly ProductRepositoryInterface $repo
    ) {}

    public function execute(int $id): void
    {
        $product = $this->repo->findById($id);

        if ($product === null) {
            return; // idempotent
        }

        $this->repo->delete($product);
    }
}