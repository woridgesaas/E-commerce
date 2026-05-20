<?php

namespace App\Application\Tenant\DTO;

class TenantAccessResponse
{
    public function __construct(
        public bool $exists,
        public bool $isAccessGranted,
        public ?string $subdomain = null,
        public ?string $status = null
    ) {}
}
