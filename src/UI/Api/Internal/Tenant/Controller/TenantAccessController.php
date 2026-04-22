<?php

namespace App\UI\Api\Internal\Tenant\Controller;
use App\Application\Tenant\Service\CheckTenantAccessService;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/api/internal/v1/tenants")]
class TenantAccessController extends AbstractController
{
    public function __construct(private CheckTenantAccessService $checkTenantAccessService){}

    #[Route('/check/{subdomain}', name: 'tenants.access', methods: ['GET'])]
    public function access(string $subdomain): JsonResponse{
        $output = $this->checkTenantAccessService->execute($subdomain);
        return $this->json(
            data:$output,
            status: Response::HTTP_OK,
            headers: ["Cache-Control"=> "public, max-age=3600" ]
        );
    }
}
