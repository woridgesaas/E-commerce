<?php

namespace App\UI\Web\Controller;

use App\Application\Subscription\Service\GetSubscriptionsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Infrastructure\Service\StrapiService;
use App\Domain\Subscription\Repository\SubscriptionRepositoryInterface;
class SubscriptionController extends AbstractController
{
    public function __construct(
        private SubscriptionRepositoryInterface $subscriptionRepository
    ) {}
    #[Route('/subscriptions', name: 'subscription_list')]
public function list(StrapiService $strapiService): Response
{
    $subs = $strapiService->getAllSubscriptions();

    return $this->render('subscriptions/list.html.twig', [
        'subs' => $subs
    ]);
}
  #[Route('/subscriptions/{type}', name: 'subscription_show')]
public function show(string $type): Response
{
    return $this->render('subscriptions/show.html.twig', [
        'type'          => strtoupper($type),
        'subscriptions' => $this->subscriptionRepository->findAll(),
    ]);
}
}