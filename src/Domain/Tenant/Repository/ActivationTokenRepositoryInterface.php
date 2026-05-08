<?php

namespace App\Domain\Tenant\Repository;

use App\Domain\Tenant\Entity\ActivationToken;
use App\Domain\Tenant\ValueObject\TokenValue;

interface ActivationTokenRepositoryInterface
{
    public function findByValue(TokenValue $value):?ActivationToken;
}
