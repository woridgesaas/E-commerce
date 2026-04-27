<?php

namespace App\UI\Web\Controller;

use App\Application\Subscription\Service\GetSubscriptionsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Infrastructure\Service\StrapiService;

class SubscriptionController extends AbstractController
{#[Route('/subscriptions', name: 'subscription_list')]
public function list(StrapiService $strapiService): Response
{
    $subs = $strapiService->getAllSubscriptions();

    return $this->render('subscription/list.html.twig', [
        'subs' => $subs
    ]);
}
   
}