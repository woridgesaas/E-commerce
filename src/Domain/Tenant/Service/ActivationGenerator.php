<?php

namespace App\Domain\Tenant\Service;

use App\Domain\Tenant\ValueObject\TokenValue;

class ActivationGenerator
{
    public function generateNewToken(): TokenValue
    {

        $rawToken = bin2hex(random_bytes(32));

        return new TokenValue($rawToken);
    }
}
