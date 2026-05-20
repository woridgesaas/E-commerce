<?php

namespace App\UI\Api\Internal\Tenant\Exception;

use App\Domain\Tenant\Exception\TokenInvalidException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Security\Core\Exception\TokenNotFoundException;

class ApiExceptionListener
{
    public function __invoke(ExceptionEvent $event):void
    {
        $exception = $event->getThrowable();
        $request = $event->getRequest();

        if(!str_starts_with($request->getPathInfo(), '/api/')) {
            return;
        }
        if ($exception instanceof \InvalidArgumentException) {
            $this->createResponse($event, Response::HTTP_BAD_REQUEST, [
                'error' => 'INVALID_ARGUMENT',
                'message' => $exception->getMessage()
            ]);
            return;
        }
        if ($exception instanceof TokenNotFoundException) {
            $this->createResponse($event, Response::HTTP_NOT_FOUND, [
                'error' => 'TOKEN_NOT_FOUND',
                'message' => $exception->getMessage()
            ]);
            return;
        }
        if ($exception instanceof TokenInvalidException) {
            $this->createResponse($event, Response::HTTP_BAD_REQUEST, [
                'error' => 'TOKEN_INVALID',
                'message' => $exception->getMessage()
            ]);
            return;
        }
        $this->createResponse($event, Response::HTTP_NOT_FOUND, [
            'error' => $exception->getMessage()
        ]);

    }

    private function createResponse(ExceptionEvent $event, int $code, array $data): void {
        $event->setResponse(new JsonResponse($data, $code));
    }
}
