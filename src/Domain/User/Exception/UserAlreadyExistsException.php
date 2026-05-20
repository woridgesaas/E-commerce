<?php

namespace App\Domain\User\Exception;

final class UserAlreadyExistsException extends \DomainException
{
    public static function withEmail(string $email): self
    {
        return new self(sprintf('Un compte existe déjà avec l\'adresse "%s".', $email));
    }
}