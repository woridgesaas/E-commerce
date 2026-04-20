<?php

namespace App\Domain\Product\Exception;

final class InvalidPriceException extends \DomainException
{
    public static function becauseNegativeOrZero(float $price): self
    {
        return new self(sprintf('Le prix "%s" doit être strictement positif.', $price));
    }
}