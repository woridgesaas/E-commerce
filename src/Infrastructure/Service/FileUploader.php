<?php

namespace App\Infrastructure\Service;

use App\Application\Shared\Port\FileUploaderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;  // ← manquait

final class FileUploader implements FileUploaderInterface
{
    public function __construct(private readonly string $uploadDir) {}
public function upload(mixed $file): ?string
{
    if (!$file instanceof UploadedFile) {
        return null;
    }

    if (!$file->isValid()) {
        return null;
    }

    $extension = $file->guessExtension() ?: 'jpg';

    $fileName = uniqid() . '.' . $extension;

    $file->move($this->uploadDir, $fileName);

    return $fileName;
}
}