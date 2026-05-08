<?php

namespace App\Application\Tenant\Message;

class ActivateCeoAccountEvent
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $password,
        public string $role,
        public string $subdomain,
        public string $cin,
        public string $phoneNumber,
        public string $departmentId,
        public string $postId,
    ) {}
}
