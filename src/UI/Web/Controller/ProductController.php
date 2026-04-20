<?php
namespace App\UI\Web\Controller;

use App\Domain\Product\Repository\ProductRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
    #[Route('/products', name: 'product_list')]
    public function list(ProductRepositoryInterface $repo): Response
    {
        return $this->render('products/list.html.twig', [
            'products' => $repo->findAll()
        ]);
    }

    #[Route('/products/{id}', name: 'product_show')]
    public function show(int $id, ProductRepositoryInterface $repo): Response
    {
        $product = $repo->findById($id);

        if (!$product) {
            throw $this->createNotFoundException('Produit introuvable');
        }

        return $this->render('products/show.html.twig', [
            'product' => $product
        ]);
    }
}