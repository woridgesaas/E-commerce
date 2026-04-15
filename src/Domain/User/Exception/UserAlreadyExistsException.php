<?php

namespace App\Domain\User\Exception;

class UserAlreadyExistsException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('A user with this email already exists.');
    }
}