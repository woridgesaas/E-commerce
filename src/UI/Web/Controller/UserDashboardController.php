<?php

namespace App\UI\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/dashboard')]
#[IsGranted('ROLE_USER')]
final class UserDashboardController extends AbstractController
{
    #[Route('', name: 'app_user_dashboard', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('user/dashboard.html.twig');
    }
}