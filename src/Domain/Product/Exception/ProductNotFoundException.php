<?php
namespace App\Domain\Product\Exception;

final class ProductNotFoundException extends \DomainException
{
    public static function withId(int $id): self
    {
        return new self(sprintf('Produit #%d introuvable.', $id));
    }
}