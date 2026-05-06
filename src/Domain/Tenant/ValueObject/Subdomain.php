<?php

namespace App\Domain\Tenant\ValueObject;

use InvalidArgumentException;

class Subdomain
{
    private string $value;
    public function __construct(string $subdomain){
        $scheped = strtolower(trim($subdomain));

        if(empty($scheped)){
            throw new InvalidArgumentException("Subdomain cannot be empty.");
        }

        if (!preg_match('/^[a-z0-9-_]+$/', $scheped)) {
            throw new InvalidArgumentException("Invalid subdomain format.");
        }

        $this->value = $scheped;
    }

    public function getValue(): string{
        return $this->value;
    }
}
