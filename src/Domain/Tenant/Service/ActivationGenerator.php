<?php

namespace App\Domain\Tenant\Service;

use App\Domain\Tenant\ValueObject\ActivationToken;

class ActivationGenerator
{
    public function generateNewToken(): ActivationToken
    {

        $rawToken = bin2hex(random_bytes(32));

        return new ActivationToken($rawToken);
    }
}
