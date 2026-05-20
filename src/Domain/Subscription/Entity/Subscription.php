<?php

namespace App\Domain\Subscription\Entity;

use App\Domain\Subscription\Enum\SubscriptionType;

class Subscription
{
    public function __construct(
        private ?int $id,
        private SubscriptionType $type,
        private int $durationInMonths,
        private float $price
    ) {}

    public function getId(): ?int { return $this->id; }
    public function getType(): SubscriptionType { return $this->type; }
    public function getDurationInMonths(): int { return $this->durationInMonths; }
    public function getPrice(): float { return $this->price; }
}