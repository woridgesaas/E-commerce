<?php

namespace App\Domain\Tenant\Entity;

use App\Domain\Tenant\Enum\TenantStatus;
use App\Domain\Tenant\ValueObject\Subdomain;
use App\Domain\Tenant\ValueObject\TokenValue;
use App\Domain\User\Entity\User;
use DateTime;

class Tenant
{
    /** @var ActivationToken[] */
    private array $activationTokens = [];
    private ?User $ceo = null;
    private ?string $companyName = null;
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
            false, // used = false
            sub:$this
        );

    }
    public function getCompanyName():string
    {
        return $this->companyName;
    }
    /** @return ActivationToken[] */
    public function getActivationTokens(): array
    {
        return $this->activationTokens;
    }

    /**
     * @param string $companyName
     * @param string $ceoEmail
     * @return $this to chain
     */
    public function setCeo(User $ceo): self
    {
        $this->ceo = $ceo;
        return $this;
    }
    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;
        return $this;
    }

    public function getCeo(): ?User
    {
        return $this->ceo;
    }

}
