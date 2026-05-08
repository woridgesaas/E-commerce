<?php

namespace App\Domain\Tenant\Entity;

use App\Domain\Tenant\Enum\TenantStatus;
use App\Domain\Tenant\ValueObject\Subdomain;
use App\Domain\Tenant\ValueObject\TokenValue;
use DateTime;

class Tenant
{
    /** @var ActivationToken[] */
    private array $activationTokens = [];
    public function __construct(
        private Subdomain $subdomain,
        private \DateTimeImmutable $endDate,
        private TenantStatus $status,
    ){}

    public function hasValidAccess():bool{
        return $this->getStatus()->canAccess() && $this->endDate > new DateTime();
    }
    public function getSubdomain(): Subdomain { return $this->subdomain; }
    public function getStatus(): TenantStatus { return $this->status; }
    public function getEndDate(): \DateTimeImmutable { return $this->endDate; }

    public function addActivationToken(TokenValue $value): void
    {

        $this->activationTokens[] = new ActivationToken(
            $value,
            new \DateTimeImmutable("+48 hours"),
            false // used = false
        );

    }
    /** @return ActivationToken[] */
    public function getActivationTokens(): array
    {
        return $this->activationTokens;
    }
}
