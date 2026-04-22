<?php

namespace App\UI\Web\Exception;

use App\Domain\Product\Exception\InvalidPriceException;
use App\Domain\Product\Exception\InvalidProductNameException;
use App\Domain\Product\Exception\InvalidProductDescriptionException;
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

final class GlobalExceptionListener
{
    public function __construct(
        private readonly RequestStack $requestStack
    ) {}

    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        // ProductNotFoundException → on la convertit en 404 Symfony
        // pour afficher la page d'erreur standard (templates/bundles/TwigBundle/Exception/error404.html.twig)
        if ($exception instanceof ProductNotFoundException) {
            $event->setThrowable(new NotFoundHttpException(
                $exception->getMessage(),
                $exception
            ));
            return; // on laisse Symfony gérer l'affichage de la 404
        }

        // Erreurs de validation métier → flash + redirect vers la page précédente
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