<?php

namespace App\Domain\Tenant\Exception;

class TokenInvalidException extends \DomainException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
