<?php
namespace App\Domain\User\Exception;

final class InvalidEmailException extends \DomainException
{
    public static function becauseEmpty(): self
    {
        return new self('L\'adresse email ne peut pas être vide.');
    }

    public static function becauseInvalidFormat(string $email): self
    {
        return new self(sprintf('"%s" n\'est pas une adresse email valide.', $email));
    }
}