<?php

namespace App\Application\Subscription\Service;

use App\Domain\Subscription\Repository\SubscriptionRepositoryInterface;

class GetSubscriptionsService
{
    public function __construct(
        private readonly SubscriptionRepositoryInterface $subscriptionRepository
    ) {}

    public function execute(): array
    {
        return $this->subscriptionRepository->findAll();
    }
}