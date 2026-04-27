<?php

namespace App\UI\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Application\Product\Service\GetProductByIdService;


final class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
#[IsGranted('ROLE_USER')]
public function index(SessionInterface $session, GetProductByIdService $service): Response
{
    $cart = $session->get('cart', []);

    $cartItems = [];
    $total = 0;

    foreach ($cart as $id => $qty) {
        $product = $service->execute($id);

        $subtotal = $product->getPrice() * $qty;

        $cartItems[] = [
            'product' => $product,
            'quantity' => $qty,
            'subtotal' => $subtotal,
        ];

        $total += $subtotal;
    }

    return $this->render('cart/index.html.twig', [
        'cartItems' => $cartItems,
        'total' => $total,
    ]);
}
 #[Route('/cart/add/{id}/{qty}', name: 'app_cart_add')]
#[IsGranted('ROLE_USER')]
public function add(int $id, int $qty, SessionInterface $session): Response
{
    $cart = $session->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id] += $qty;
    } else {
        $cart[$id] = $qty;
    }

    $session->set('cart', $cart);

    return $this->redirectToRoute('app_cart');
}
#[Route('/cart/add-subscription/{id}', name: 'cart_add_subscription')]
public function addSubscription(int $id, SessionInterface $session)
{
    $cart = $session->get('cart', []);

    $cart[] = [
        'type' => 'subscription',
        'id' => $id
    ];

    $session->set('cart', $cart);

    return $this->redirectToRoute('cart_index');
}
}