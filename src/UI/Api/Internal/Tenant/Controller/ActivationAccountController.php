<?php

namespace App\UI\Api\Internal\Tenant\Controller;

use App\Application\Tenant\Service\WelcomeTenantService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/api/internal/v1/onboarding")]
class ActivationAccountController extends AbstractController
{
    public function __construct(private readonly WelcomeTenantService $welcomeTenantService)
    {

    }
    #[Route(path: '/check/{token}', name: 'activation_account', methods: ['GET'])]
    public function check(string $token):JsonResponse{
        $this->welcomeTenantService->checkToken($token);
        return $this->json(
            data:"",
            status: Response::HTTP_OK
        );
    }
}
