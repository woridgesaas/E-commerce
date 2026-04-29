<?php

namespace App\UI\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Application\Product\Service\GetProductByIdService;

final class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    #[IsGranted('ROLE_USER')]
    public function index(
        SessionInterface $session,
        GetProductByIdService $productService
    ): Response {

        $cart = $session->get('cart', []);

        $cartItems = [];
        $total = 0;

        foreach ($cart as $key => $item) {

            // 🔹 PRODUIT
            if ($item['type'] === 'product') {

                $product = $productService->execute($item['id']);

                $subtotal = $product->getPrice() * $item['quantity'];

                $cartItems[] = [
                    'key' => $key,
                    'type' => 'product',
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal,
                ];

                $total += $subtotal;
            }

            // 🔹 ABONNEMENT
            if ($item['type'] === 'subscription') {

                // ⚡ ici tu peux récupérer prix depuis DB plus tard
                $cartItems[] = [
                    'key' => $key,
                    'type' => 'subscription',
                    'id' => $item['id'],
                    'duration' => $item['duration'] ?? null,
                ];
            }
        }

        return $this->render('cart/index.html.twig', [
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }

    // 🔹 Ajouter produit
    #[Route('/cart/add/{id}/{qty}', name: 'app_cart_add')]
    #[IsGranted('ROLE_USER')]
    public function add(
        int $id,
        int $qty,
        SessionInterface $session
    ): Response {

        $cart = $session->get('cart', []);

        $cart[] = [
            'type' => 'product',
            'id' => $id,
            'quantity' => $qty
        ];

        $session->set('cart', $cart);

        return $this->redirectToRoute('app_cart');
    }

    // 🔹 Ajouter abonnement
    #[Route('/cart/add-subscription/{id}', name: 'cart_add_subscription')]
    #[IsGranted('ROLE_USER')]
    public function addSubscription(
        Request $request,
        int $id,
        SessionInterface $session
    ): Response {

        $duration = $request->query->get('duration');

        $cart = $session->get('cart', []);

        $cart[] = [
            'type' => 'subscription',
            'id' => $id,
            'duration' => $duration
        ];

        $session->set('cart', $cart);

        return $this->redirectToRoute('app_cart');
    }

    // 🔹 Supprimer item
    #[Route('/cart/remove/{key}', name: 'cart_remove')]
    #[IsGranted('ROLE_USER')]
    public function remove(int $key, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);

        if (isset($cart[$key])) {
            unset($cart[$key]);
        }

        // réindexer tableau
        $cart = array_values($cart);

        $session->set('cart', $cart);

        return $this->redirectToRoute('app_cart');
    }

    // 🔹 Vider panier
    #[Route('/cart/clear', name: 'cart_clear')]
    #[IsGranted('ROLE_USER')]
    public function clear(SessionInterface $session): Response
    {
        $session->remove('cart');

        return $this->redirectToRoute('app_cart');
    }
}