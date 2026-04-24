<?php

namespace App\Infrastructure\Service;

use App\Application\User\Port\MailerPort;
use App\Domain\User\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class SymfonyMailerAdapter implements MailerPort
{
    public function __construct(
        private MailerInterface $mailer,
        private Environment $twig,
        private UrlGeneratorInterface $router,
        private string $fromEmail
    ) {}

    public function sendPasswordReset(User $user, string $token): void
    {
        $link = $this->router->generate(
            'app_reset_password',
            ['token' => $token],
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        $html = $this->twig->render('security/emails/reset_password.html.twig', [
            'user' => $user,
            'link' => $link
        ]);

        $email = (new Email())
            ->from($this->fromEmail) 
            ->to($user->getEmail()->value())
            ->subject('Reset Password')
            ->html($html);

        $this->mailer->send($email);
    }
}