<?php

namespace App\Domain\Subscription\Repository;

use App\Domain\Subscription\Entity\Subscription;

interface SubscriptionRepositoryInterface
{
    public function findAll(): array;

    public function findById(int $id): ?Subscription;

    public function findByType(string $type): array;
}