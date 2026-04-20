<?php

namespace App\Domain\Product\Exception;

final class InvalidProductNameException extends \DomainException
{
    public static function becauseEmpty(): self
    {
        return new self('Le nom du produit ne peut pas être vide.');
    }

    public static function becauseTooShort(string $value): self
    {
        return new self(sprintf('"%s" est trop court (minimum 2 caractères).', $value));
    }
}