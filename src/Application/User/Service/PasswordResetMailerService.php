<?php

namespace App\Application\User\Service;

use App\Domain\User\Entity\User;
use Symfony\Component\Mailer\MailerInterface;          // ← Infrastructure Symfony
use Symfony\Component\Mime\Email as MimeEmail;          // ← MimeEmail
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;                                   // ← Twig\Environment, pas App\...

final class PasswordResetMailerService
{
    public function __construct(
        private readonly MailerInterface       $mailer,
        private readonly Environment           $twig,
        private readonly UrlGeneratorInterface $urlGenerator,
        private readonly string                $fromEmail
    ) {}

    public function send(User $user, string $token): void
    {
        $link = $this->urlGenerator->generate(
            'app_reset_password',
            ['token' => $token],
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        $html = $this->twig->render('security/emails/reset_password.html.twig', [
            'link' => $link,
            'user' => $user,
        ]);

        $email = (new MimeEmail())
            ->from($this->fromEmail)
            ->to($user->getEmail()->value())
            ->subject('Réinitialisation de votre mot de passe')
            ->html($html);

        $this->mailer->send($email);
    }
}