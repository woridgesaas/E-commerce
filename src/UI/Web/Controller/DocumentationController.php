<?php
// src/UI/Web/Controller/DocumentationController.php
namespace App\UI\Web\Controller;

use App\Infrastructure\Service\StrapiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DocumentationController extends AbstractController
{#[Route('/documentations', name: 'documentation_list')]
public function list(StrapiService $strapiService): Response
{
    $docs = $strapiService->getAllDocumentations();
    $subs = $strapiService->getAllSubscriptions(); 

    return $this->render('documentation/list.html.twig', [
        'docs' => $docs,
        'subscriptions' => $subs
    ]);
}

    #[Route('/documentations/product/{productId}', name: 'documentation_by_product')]
public function showByProduct(
    int $productId,
    StrapiService $strapiService
): Response {

    $docs = $strapiService->getDocumentationByProductId($productId);

    if (empty($docs)) {
        throw $this->createNotFoundException('Documentation non trouvée');
    }

    $doc = $docs[0]; 

    return $this->render('documentation/show.html.twig', [
        'doc' => $doc
    ]);
}

#[Route('/subscriptions/{type}', name: 'subscription_show')]
public function showSubscription(
    string $type,
    StrapiService $strapiService
): Response {

    $subs = $strapiService->getSubscriptionByType($type);

    if (empty($subs)) {
        throw $this->createNotFoundException('Abonnement non trouvé');
    }

    return $this->render('documentation/show.subscription.html.twig', [
        'sub' => $subs[0]
    ]);
}
}