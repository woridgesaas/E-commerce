<?php

namespace App\Domain\Tenant\Entity;

use App\Domain\Tenant\ValueObject\TokenValue;

class ActivationToken
{

    private TokenValue $value;
    private \DateTimeImmutable $expiresAt;
    private bool $used = false;

    private Tenant $subscription;

    /**
     * @param TokenValue $value
     * @param \DateTimeImmutable $expiresAt
     * @param bool $used
     */
    public function __construct(TokenValue $value, \DateTimeImmutable $expiresAt, bool $used , Tenant $sub)
    {
        $this->value = $value;
        $this->expiresAt = $expiresAt;
        $this->used = $used;
        $this->subscription = $sub;
    }

    /**
     * @return Tenant
     */
    public function getSubscription(): Tenant
    {
        return $this->subscription;
    }
    public function getValue(): TokenValue
    {
        return $this->value;
    }

    public function setValue(TokenValue $value): void
    {
        $this->value = $value;
    }

    public function isExpired(): bool
    {
        return new \DateTimeImmutable() > $this->expiresAt;
    }

    public function setExpiresAt(\DateTimeImmutable $expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }

    public function isUsed(): bool
    {
        return $this->used;
    }

    public function setUsed(bool $used): void
    {
        $this->used = $used;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getExpiresAt(): \DateTimeImmutable
    {
        return $this->expiresAt;
    }


}
