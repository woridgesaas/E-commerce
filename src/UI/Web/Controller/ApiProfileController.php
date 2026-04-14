<?php

namespace App\UI\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/api')]
#[IsGranted('ROLE_USER')]
final class ApiProfileController extends AbstractController
{
    #[Route('/me', name: 'api_me', methods: ['GET'])]
    public function me(): JsonResponse
    {
        $user = $this->getUser();

        return $this->json([
            'identifier' => $user?->getUserIdentifier(),
            'roles'      => $user?->getRoles(),
        ]);
    }
}