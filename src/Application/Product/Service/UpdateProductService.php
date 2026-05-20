<?php

namespace App\Application\Product\Service;

use App\Application\Product\DTO\UpdateProductInput;
use App\Domain\Product\Exception\ProductNotFoundException;  // ← manquait
use App\Domain\Product\Repository\ProductRepositoryInterface;

final class UpdateProductService
{
    public function __construct(
        private readonly ProductRepositoryInterface $repo
    ) {}

    public function execute(UpdateProductInput $input): void
    {
        $product = $this->repo->findById($input->id);

        if ($product === null) {
            throw ProductNotFoundException::withId($input->id);
        }

        $product->update(
            $input->name,
            $input->description,
            $input->type,
            $input->price,
            $input->image
        );

        $this->repo->save($product);
    }
}