<?php

namespace App\UI\Web\Controller;
use App\Application\User\Service\ResetPasswordService;
use App\Application\User\Port\PasswordHasherInterface;
use App\Application\User\Service\PasswordResetService;  
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\Email as UserEmail;
use App\UI\Web\Form\RegisterType;
use App\UI\Web\Form\ResetPasswordType;
use App\Application\User\Service\CreateUserService;
use App\Domain\User\ValueObject\UserRole;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AuthController extends AbstractController
{
   #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
public function register(Request $request, CreateUserService $service): Response
{
    if ($this->getUser()) {
        return $this->redirectToRoute('app_home');
    }

    $form = $this->createForm(RegisterType::class);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $data = $form->getData();

        try {
            $service->execute(
                $data['firstName'],
                $data['lastName'],
                strtolower(trim($data['email'])),
                $data['password'],
                UserRole::USER 
            );

            $this->addFlash('success', 'Compte créé avec succès !');
            return $this->redirectToRoute('app_login');

        } catch (\DomainException $e) {
            $this->addFlash('error', $e->getMessage());
        }
    }

    return $this->render('security/register.html.twig', [
        'form' => $form->createView(),
    ]);
}

    #[Route('/forgot-password', name: 'app_forgot_password', methods: ['GET', 'POST'])]
public function forgot(
    Request $request,
    PasswordResetService $service 
): Response {
    if ($request->isMethod('POST')) {
        $emailInput = strtolower(trim((string) $request->request->get('email')));

        $service->request($emailInput);

        $this->addFlash('success', "Si l'adresse existe, un lien vous a été envoyé.");
        return $this->redirectToRoute('app_login');
    }

    return $this->render('security/forgot.html.twig');
}

   #[Route('/reset-password/{token}', name: 'app_reset_password', methods: ['GET', 'POST'])]
public function reset(
    Request $request,
    string $token,
    ResetPasswordService $service 
): Response {
    $form = $this->createForm(ResetPasswordType::class);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $data = $form->getData();

        try {
            $service->execute($token, $data['password']);

            $this->addFlash('success', 'Mot de passe mis à jour avec succès !');
            return $this->redirectToRoute('app_login');

        } catch (\DomainException $e) {
            $this->addFlash('error', $e->getMessage());
            return $this->redirectToRoute('app_forgot_password');
        }
    }

    return $this->render('security/reset.html.twig', [
        'form'  => $form->createView(),
        'token' => $token
    ]);
}
}