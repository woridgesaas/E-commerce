<?php

namespace App\Application\User\Port;

use App\Domain\User\Entity\User;

interface MailerPort
{
    public function sendPasswordReset(User $user, string $token): void;
}