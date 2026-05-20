<?php

namespace App\UI\Web\Exception;

use App\Domain\Product\Exception\InvalidPriceException;
use App\Domain\Product\Exception\InvalidProductDescriptionException;
use App\Domain\Product\Exception\InvalidProductNameException;
use App\Domain\Product\Exception\ProductNotFoundException;
use App\Domain\User\Exception\InvalidEmailException;
use App\Domain\User\Exception\InvalidUserNameException;
use App\Domain\User\Exception\UserAlreadyExistsException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\FlashBagAwareSessionInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Twig\Environment;

final class GlobalExceptionListener
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly Environment $twig
    ) {}

    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        // 403 - accès refusé
        if ($exception instanceof AccessDeniedException) {
            $html = $this->twig->render('errors/403.html.twig', [
                'message' => "Vous n'avez pas les droits pour accéder à cette page."
            ]);

            $event->setResponse(new Response($html, 403));
            return;
        }

        // ProductNotFoundException -> 404 Symfony
        if ($exception instanceof ProductNotFoundException) {
            $event->setThrowable(new NotFoundHttpException(
                $exception->getMessage(),
                $exception
            ));
            return;
        }

        // Erreurs métier de validation -> flash + redirect
        if (!$this->isValidationException($exception)) {
            return;
        }

        $request = $this->requestStack->getCurrentRequest();

        if ($request === null) {
            return;
        }

        $session = $request->getSession();

        if ($session instanceof FlashBagAwareSessionInterface) {
            $session->getFlashBag()->add('error', $exception->getMessage());
        }

        $referer = $request->headers->get('referer') ?? '/';
        $event->setResponse(new RedirectResponse($referer));
    }

    private function isValidationException(\Throwable $exception): bool
    {
        return $exception instanceof UserAlreadyExistsException
            || $exception instanceof InvalidEmailException
            || $exception instanceof InvalidUserNameException
            || $exception instanceof InvalidPriceException
            || $exception instanceof InvalidProductNameException
            || $exception instanceof InvalidProductDescriptionException;
    }
}