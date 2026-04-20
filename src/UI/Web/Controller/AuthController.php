<?php

namespace App\UI\Web\Controller;

use App\Application\User\DTO\RegisterUserInput;
use App\Application\User\Port\PasswordHasherInterface;
use App\Application\User\Service\PasswordResetMailerService;  // ← manquait
use App\Application\User\Service\RegisterUserService;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\Email as UserEmail;
use App\UI\Web\Form\RegisterType;
use App\UI\Web\Form\ResetPasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AuthController extends AbstractController
{
    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(Request $request, RegisterUserService $service): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_dashboard');
        }

        $form = $this->createForm(RegisterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            try {
                $service->execute(new RegisterUserInput(
                    firstName: $data['firstName'],
                    lastName:  $data['lastName'],
                    email:     strtolower(trim($data['email'])),
                    password:  $data['password']
                ));

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
        UserRepositoryInterface $repo,
        PasswordResetMailerService $mailerService
    ): Response {
        if ($request->isMethod('POST')) {
            $emailInput = strtolower(trim((string) $request->request->get('email')));

            try {
                $user = $repo->findByEmail(new UserEmail($emailInput));
            } catch (\Exception) {
                $user = null;
            }

            if ($user !== null) {
                $token = bin2hex(random_bytes(32));
                $user->requestPasswordReset($token, new \DateTimeImmutable('+1 hour'));
                $repo->save($user);
                $mailerService->send($user, $token);
            }

            $this->addFlash('success', "Si l'adresse existe, un lien vous a été envoyé.");
            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/forgot.html.twig');
    }

    #[Route('/reset-password/{token}', name: 'app_reset_password', methods: ['GET', 'POST'])]
    public function reset(
        Request $request,
        string $token,
        UserRepositoryInterface $repository,
        PasswordHasherInterface $hasher
    ): Response {
        $user = $repository->findByResetToken($token);

        if ($user === null || $user->isResetTokenExpired()) {
            $this->addFlash('error', 'Lien invalide ou expiré.');
            return $this->redirectToRoute('app_forgot_password');
        }

        $form = $this->createForm(ResetPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $user->changePassword($hasher->hash($data['password']));
            $user->clearResetToken();
            $repository->save($user);

            $this->addFlash('success', 'Mot de passe mis à jour avec succès !');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/reset.html.twig', [
            'form'  => $form->createView(),
            'token' => $token,
            'user'  => $user, 
        ]);
    }
}