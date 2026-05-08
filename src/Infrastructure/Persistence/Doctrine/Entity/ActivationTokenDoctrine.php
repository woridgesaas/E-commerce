<?php

namespace App\Infrastructure\Persistence\Doctrine\Entity;
use App\Domain\Tenant\ValueObject\TokenValue;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity]
#[ORM\Table(name: 'activation_tokens')]
class ActivationTokenDoctrine
{
    public function __construct(string $tokenValue, \DateTimeImmutable $date, SubscriptionRegistryDoctrine $subscription)
    {
        $this->value = $tokenValue;
        $this->expireAt = $date;
        $this->subscription = $subscription;
    }
    #[ORM\Id, ORM\GeneratedValue(strategy: 'AUTO') , ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING , length: 255 , unique: true)]
    private string $value;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: false)]
    private \DateTimeImmutable $expireAt;

    #[ORM\Column(type: Types::BOOLEAN , nullable: false)]
    private bool $used = false;

    #[ORM\ManyToOne(targetEntity: SubscriptionRegistryDoctrine::class, inversedBy: 'activationTokens')]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]

    /** @var SubscriptionRegistryDoctrine $sub*/
    private SubscriptionRegistryDoctrine $subscription;

    /**
     * @return SubscriptionRegistryDoctrine
     */
    public function getSubscription(): SubscriptionRegistryDoctrine{
        return $this->subscription;
}
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getExpireAt(): \DateTimeImmutable
    {
        return $this->expireAt;
    }

    public function setExpireAt(\DateTimeImmutable $expireAt): void
    {
        $this->expireAt = $expireAt;
    }

    public function isUsed(): bool
    {
        return $this->used;
    }

    public function setUsed(bool $used): void
    {
        $this->used = $used;
    }

    public function setSubscription(SubscriptionRegistryDoctrine $param) :void
    {
        $this->subscription = $param;
    }


}
