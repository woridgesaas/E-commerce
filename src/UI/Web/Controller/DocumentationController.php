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
#[Route('/documentations/subscription/{type}', name: 'documentation_by_subscription')]
public function showBySubscription(
    string $type,
    StrapiService $strapiService
): Response {

    $docs = $strapiService->getSubscriptionByType($type);

    if (empty($docs)) {
        throw $this->createNotFoundException('Documentation abonnement non trouvée');
    }

    $sub = $docs[0]; // prendre le premier

return $this->render('documentation/show.subscription.html.twig', [
    'sub' => $sub
]);
}
}