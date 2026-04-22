<?php
namespace App\Domain\Product\Exception;

final class ProductImageRequiredException extends \DomainException
{
    public static function missing(): self
    {
        return new self("L'image du produit est obligatoire.");
    }
}