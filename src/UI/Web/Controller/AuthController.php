<?php

namespace App\UI\Web\Controller;

use App\Application\User\DTO\RegisterUserInput;
use App\Application\User\Service\RegisterUserService;
use App\UI\Web\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{
    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(Request $request, RegisterUserService $service): Response
    {
        $form = $this->createForm(RegisterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            try {
                $service->execute(new RegisterUserInput(
                    $data['firstName'],
                    $data['lastName'],
                    $data['email'],
                    $data['password']  // mot de passe déjà validé (repeated)
                ));

                $this->addFlash('success', 'Compte créé avec succès ! Connectez-vous.');
                return $this->redirectToRoute('app_login');

            } catch (\DomainException $e) {
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}