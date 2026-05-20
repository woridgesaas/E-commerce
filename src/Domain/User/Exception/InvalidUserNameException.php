<?php

namespace App\Domain\User\Exception;

final class InvalidUserNameException extends \DomainException
{
    public static function becauseEmpty(): self
    {
        return new self('Le nom ne peut pas être vide.');
    }

    public static function becauseTooShort(string $value): self
    {
        return new self(sprintf('"%s" est trop court (minimum 2 caractères).', $value));
    }

    public static function becauseTooLong(string $value): self
    {
        return new self(sprintf('"%s" est trop long (maximum 100 caractères).', $value));
    }
}