<?php

namespace App\UI\Web\Controller;

use App\Application\User\DTO\RegisterUserInput;
use App\Application\User\Port\PasswordHasherInterface;
use App\Application\User\Service\RegisterUserService;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\Email as UserEmail;

use App\UI\Web\Form\RegisterType;
use App\UI\Web\Form\ResetPasswordType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email as MimeEmail;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AuthController extends AbstractController
{
    // ---------------------------------------------------------------
    // REGISTER
    // ---------------------------------------------------------------
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

                $this->addFlash('success', 'Account created successfully!');
                return $this->redirectToRoute('app_login');

            } catch (\DomainException $e) {
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // ---------------------------------------------------------------
    // FORGOT PASSWORD
    // ---------------------------------------------------------------
    #[Route('/forgot-password', name: 'app_forgot_password', methods: ['GET', 'POST'])]
    public function forgot(
        Request $request,
        UserRepositoryInterface $repo,
        MailerInterface $mailer
    ): Response {
       if ($request->isMethod('POST')) {

    $emailInput = strtolower(trim($request->request->get('email')));

    try {
        $user = $repo->findByEmail(new UserEmail($emailInput));
    } catch (\Exception) {
        $user = null;
    }

    if ($user) {
        $token = bin2hex(random_bytes(32));

        $user->requestPasswordReset(
            $token,
            new \DateTimeImmutable('+1 hour')
        );

        $repo->save($user);

        $link = $this->generateUrl(
            'app_reset_password',
            ['token' => $token],
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        $html = $this->renderView('security/emails/reset_password.html.twig', [
            'link' => $link,
            'user' => $user,
        ]);

        $email = (new MimeEmail())
            ->from('zeroualisafae16@gmail.com')
            ->to($emailInput)
            ->subject('Reset your password')
            ->html($html);

        $mailer->send($email);
    }

    $this->addFlash('success', 'If email exists, link sent');
    return $this->redirectToRoute('app_login');
}

        return $this->render('security/forgot.html.twig');
    }

    // ---------------------------------------------------------------
    // RESET PASSWORD
    // ---------------------------------------------------------------
    #[Route('/reset-password/{token}', name: 'app_reset_password', methods: ['GET', 'POST'])]
    public function reset(
        Request $request,
        string $token,
        UserRepositoryInterface $repository,
        PasswordHasherInterface $hasher
    ): Response {

        $user = $repository->findByResetToken($token);

        if ($user === null || $user->isResetTokenExpired()) {
            $this->addFlash('error', 'Invalid or expired link.');
            return $this->redirectToRoute('app_forgot_password');
        }

        $form = $this->createForm(ResetPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $hashedPassword = $hasher->hash($data['password']);

            $user->changePassword($hashedPassword);
            $user->clearResetToken();

            $repository->save($user);

            $this->addFlash('success', 'Password updated successfully!');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/reset.html.twig', [
            'form'  => $form->createView(),
            'token' => $token,
        ]);
    }

   
}