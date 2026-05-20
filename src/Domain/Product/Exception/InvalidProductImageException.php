<?php

namespace App\Domain\Product\Exception;
namespace App\Domain\Product\Exception;

final class InvalidProductImageException extends \DomainException
{
    public static function unsupportedFormat(): self
    {
        return new self("Format d'image non supporté (jpg, jpeg, png, webp).");
    }

    public static function tooLarge(): self
    {
        return new self("Image trop volumineuse (max 5MB).");
    }

    public static function uploadFailed(): self
    {
        return new self("Erreur lors de l'upload de l'image.");
    }

    public static function invalidFile(): self
    {
        return new self("Fichier image invalide.");
    }
}