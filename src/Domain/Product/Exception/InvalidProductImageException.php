<?php

namespace App\Domain\Product\Exception;

final class InvalidProductImageException extends \DomainException
{
    public static function unsupportedFormat(): self
    {
        return new self("Format d'image non supporté (jpg, png uniquement).");
    }
}