<?php

namespace App\UI\Web\Controller\Admin;

use App\Application\User\Service\CreateUserService;
use App\Domain\User\ValueObject\UserRole;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/users')]
#[IsGranted('ROLE_ADMIN')]
final class UserAdminController extends AbstractController
{
    #[Route('/add', name: 'admin_user_add', methods: ['GET', 'POST'])]
    public function add(Request $request, CreateUserService $service): Response
    {
        if ($request->isMethod('POST')) {

            $service->execute(
                $request->get('firstName'),
                $request->get('lastName'),
                $request->get('email'),
                $request->get('password'),
                UserRole::ADMIN
            );

            $this->addFlash('success', 'Admin créé');
            return $this->redirectToRoute('app_admin_dashboard');
        }

        return $this->render('admin/user/add.html.twig');
    }
}