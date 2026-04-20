<?php

 namespace App\Application\Shared\Port;
 
interface FileUploaderInterface
{
    public function upload(mixed $file): ?string;
}