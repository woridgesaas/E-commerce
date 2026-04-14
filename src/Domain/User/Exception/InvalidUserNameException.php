<?php

namespace App\Domain\User\Exception;

class InvalidUserNameException extends \DomainException
{
    public function __construct(string $message = 'Le nom ne peut pas être vide.')
    {
        parent::__construct($message);
    }
}