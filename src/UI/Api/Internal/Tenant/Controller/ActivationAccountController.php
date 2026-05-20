<?php

namespace App\UI\Api\Internal\Tenant\Controller;

use App\Application\Tenant\DTO\TenantAccountVerifyResponse;
use App\Application\Tenant\Service\WelcomeTenantService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/api/internal/v1/onboarding")]
class ActivationAccountController extends AbstractController
{
    public function __construct(private readonly WelcomeTenantService $welcomeTenantService)
    {

    }
    #[Route(path: '/check/{token}', name: 'verify_activation_account', methods: ['GET'])]
    public function check(string $token):JsonResponse{
        $response= $this->welcomeTenantService->checkToken($token);
        return $this->json(
            data:$response,
            status: Response::HTTP_OK
        );
    }

    /**
     * @throws ExceptionInterface
     */
    #[Route(path: '/confirm', name: 'confirm_activation_account', methods: ['POST'])]
    public function confirm(Request $request):JsonResponse{

        $data = json_decode($request->getContent(), true);
        $this->welcomeTenantService->confirmActivation(
            $data['token'],
            $data['password']
        );
        return $this->json(['message' => 'Activing ...'], Response::HTTP_ACCEPTED);
    }
}
