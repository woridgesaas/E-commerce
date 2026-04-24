<?php

namespace App\Application\User\Service;

use App\Application\User\Port\MailerPort;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\Email;
final class PasswordResetService
{
    public function __construct(
        private UserRepositoryInterface $repo,
        private MailerPort $mailer
    ) {}

    public function request(string $email): void
    {
        $user = $this->repo->findByEmail(new Email($email)); // utilise Email VO

        if (!$user) {
            return; 
        }

        $token = bin2hex(random_bytes(32));

        $user->requestPasswordReset($token, new \DateTimeImmutable('+1 hour'));

        $this->repo->save($user);

        $this->mailer->sendPasswordReset($user, $token);
    }
}