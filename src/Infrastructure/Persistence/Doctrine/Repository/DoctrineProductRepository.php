<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Product\Entity\Product;
use App\Domain\Product\Repository\ProductRepositoryInterface;
use App\Infrastructure\Persistence\Doctrine\Entity\ProductDoctrine;
use App\Infrastructure\Persistence\Doctrine\Mapper\ProductMapper;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private ProductMapper $mapper
    ) {}

    public function save(Product $product): void
    {
        $existing = null;

        if ($product->getId() !== null) {
            $existing = $this->em->getRepository(ProductDoctrine::class)->find($product->getId());
        }

        if ($existing === null) {
            $entity = $this->mapper->toDoctrine($product);
            $this->em->persist($entity);
        } else {
            $this->mapper->fill($product, $existing);
        }

        $this->em->flush();
    }

    public function findAll(): array
    {
        $entities = $this->em->getRepository(ProductDoctrine::class)->findAll();

        return array_map(fn($e) => $this->mapper->toDomain($e), $entities);
    }

    public function findById(int $id): ?Product
    {
        $entity = $this->em->getRepository(ProductDoctrine::class)->find($id);

        return $entity ? $this->mapper->toDomain($entity) : null;
    }

    public function delete(Product $product): void
    {
        $entity = $this->em->getRepository(ProductDoctrine::class)->find($product->getId());

        if ($entity) {
            $this->em->remove($entity);
            $this->em->flush();
        }
    }
    public function findLatest(int $limit): array
{
    $entities = $this->em->getRepository(ProductDoctrine::class)
        ->createQueryBuilder('p')
        ->setMaxResults($limit)
        ->orderBy('p.id', 'DESC')
        ->getQuery()
        ->getResult();

    return array_map(fn($e) => $this->mapper->toDomain($e), $entities);
}
}