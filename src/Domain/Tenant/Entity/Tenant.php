<?php

namespace App\Domain\Tenant\Entity;

use App\Domain\Tenant\Enum\TenantStatus;
use App\Domain\Tenant\ValueObject\Subdomain;
use DateTime;

class Tenant
{
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
}
