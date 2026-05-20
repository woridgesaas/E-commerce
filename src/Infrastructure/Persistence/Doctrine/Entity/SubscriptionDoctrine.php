<?php

namespace App\Infrastructure\Persistence\Doctrine\Entity;

use App\Domain\Subscription\Enum\SubscriptionType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'subscriptions')]
class SubscriptionDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 50)]
    private string $type;

    #[ORM\Column(type: 'integer')]
    private int $durationInMonths;

    #[ORM\Column(type: 'float')]
    private float $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): SubscriptionType
    {
        return SubscriptionType::from($this->type);
    }

    public function setType(SubscriptionType $type): self
    {
        $this->type = $type->value;
        return $this;
    }

    public function getDurationInMonths(): int
    {
        return $this->durationInMonths;
    }

    public function setDurationInMonths(int $durationInMonths): self
    {
        $this->durationInMonths = $durationInMonths;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }
}