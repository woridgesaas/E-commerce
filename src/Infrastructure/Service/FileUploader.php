<?php

namespace App\Infrastructure\Service;

use App\Application\Shared\Port\FileUploaderInterface;
use App\Domain\Product\Exception\InvalidProductImageException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class FileUploader implements FileUploaderInterface
{
    private const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'webp'];
    private const MAX_SIZE = 5_000_000; // 5MB

    public function __construct(
        private readonly string $uploadDir
    ) {}

    public function upload(mixed $file): ?string
    {
        //  Pas de fichier envoyé → OK (optionnel)
        if (!$file instanceof UploadedFile) {
            return null;
        }

        //  Fichier invalide
        if (!$file->isValid()) {
            throw InvalidProductImageException::invalidFile();
        }

        //  Taille max
        if ($file->getSize() > self::MAX_SIZE) {
            throw InvalidProductImageException::tooLarge();
        }

        // Extension sécurisée
        $extension = strtolower($file->guessExtension() ?? '');

        if (!in_array($extension, self::ALLOWED_EXTENSIONS, true)) {
            throw InvalidProductImageException::unsupportedFormat();
        }

        //  Nom sécurisé (anti collision + anti hack)
        $fileName = bin2hex(random_bytes(16)) . '.' . $extension;

        // Upload physique
        try {
            $file->move($this->uploadDir, $fileName);
        } catch (\Exception) {
            throw InvalidProductImageException::uploadFailed();
        }

        return $fileName;
    }
}