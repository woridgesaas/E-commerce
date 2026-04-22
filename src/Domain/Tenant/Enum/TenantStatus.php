<?php

namespace App\Domain\Tenant\Enum;

enum TenantStatus:string
{
    case ACTIVE = 'active';
    case EXPIRED = 'expired';
    case CANCELED = 'canceled';

    public function canAccess(): bool
    {
        return $this === self::ACTIVE;
    }
}
