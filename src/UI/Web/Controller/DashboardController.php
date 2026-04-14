<?php

namespace App\UI\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard', methods: ['GET'])]
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->render('dashboard/index.html.twig', [
            'user' => $user,
        ]);
    }
}