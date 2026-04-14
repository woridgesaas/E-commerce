<?php

namespace App\Domain\User\Exception;

class UserAlreadyExistsException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Un utilisateur avec cet email existe déjà.');
    }
}