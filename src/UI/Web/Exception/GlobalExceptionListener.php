<?php

namespace App\UI\Web\Exception;

use App\Domain\User\Exception\InvalidEmailException;
use App\Domain\User\Exception\InvalidUserNameException;
use App\Domain\User\Exception\UserAlreadyExistsException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;

final class GlobalExceptionListener
{
    public function __construct(
        private readonly RequestStack $requestStack
    ) {}

    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        // ✅ Vérifie si c'est une exception métier
        if (!$this->isHandled($exception)) {
            return;
        }

        $request = $this->requestStack->getCurrentRequest();

        if (!$request) {
            return;
        }

        // Session propre (fix IDE + safe runtime)
        /** @var Session $session */
        $session = $request->getSession();
        $session->getFlashBag()->add('error', $exception->getMessage());

        // ✅ Redirection
        $referer = $request->headers->get('referer') ?? '/register';

        $event->setResponse(new RedirectResponse($referer));
    }

    // 🔥 meilleure lisibilité (niveau senior)
    private function isHandled(\Throwable $exception): bool
    {
        return $exception instanceof UserAlreadyExistsException
            || $exception instanceof InvalidEmailException
            || $exception instanceof InvalidUserNameException;
    }
}
