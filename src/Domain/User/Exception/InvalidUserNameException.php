<?php

namespace App\Domain\User\Exception;

class InvalidUserNameException extends \DomainException
{
    public function __construct(string $message = 'The name cannot be empty.')
    {
        parent::__construct($message);
    }
}