<?php
namespace App\UI\Web\Controller;

use App\Domain\Product\Repository\ProductRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Application\Product\Service\GetProductByIdService;
use App\Application\Product\Service\GetProductsService;

use App\Infrastructure\Service\StrapiService;


final class ProductController extends AbstractController
{

#[Route('/products', name: 'product_list')]
public function list(GetProductsService $service): Response
{
    return $this->render('products/list.html.twig', [
        'products' => $service->execute()
    ]);
}

 #[Route('/products/{id}', name: 'product_show')]
public function show(
    int $id,
    GetProductByIdService $service,
    StrapiService $strapiService
): Response {
    
    $product = $service->execute($id);

    $docs = $strapiService->getDocumentationByProductId($id);
    return $this->render('products/show.html.twig', [
        'product' => $product,
        'docs' => $docs
    ]);
}
}