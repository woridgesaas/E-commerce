<?php

namespace App\UI\Web\Controller;

use App\Application\Product\Service\GetHomepageProductsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
public function index(GetHomepageProductsService $service): Response
{
    return $this->render('home/index.html.twig', [
        'products' => $service->execute()
    ]);
}
}