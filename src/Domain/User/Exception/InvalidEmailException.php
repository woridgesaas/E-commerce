<?php

namespace App\Domain\User\Exception;

class InvalidEmailException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Adresse email invalide.');
    }
}