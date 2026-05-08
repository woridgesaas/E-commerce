<?php

namespace App\Application\Tenant\DTO;

class TenantAccountVerifyResponse
{
    public function __construct(
        public string $email ,
        public string $firstName ,
        public string $lastName ,
        public string $companyName ,
        public string $subdomain)
    {

    }
}
