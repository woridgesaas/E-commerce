<?php

namespace App\Domain\Product\Exception;
final class InvalidProductDescriptionException extends \DomainException
{
    public static function becauseEmpty(): self
    {
        return new self("La description est obligatoire.");
    }
}
