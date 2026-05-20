<?php
// src/UI/Web/Controller/Admin/ProductAdminController.php
namespace App\UI\Web\Controller\Admin;

use App\Application\Product\DTO\CreateProductInput;
use App\Application\Product\DTO\UpdateProductInput;
use App\Application\Product\Service\CreateProductService;
use App\Application\Product\Service\DeleteProductService;
use App\Application\Product\Service\UpdateProductService;
use App\Application\Shared\Port\FileUploaderInterface;
use App\Domain\Product\ValueObject\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Application\Product\Service\GetProductsService;
use App\Application\Product\Service\GetProductByIdService; 


#[Route('/admin/products')]
#[IsGranted('ROLE_ADMIN')]
final class ProductAdminController extends AbstractController
{
    #[Route('', name: 'admin_products', methods: ['GET'])]
   public function list(GetProductsService $service): Response
{
    return $this->render('admin/products/list.html.twig', [
        'products' => $service->execute(),
    ]);
}

    #[Route('/add', name: 'admin_product_add', methods: ['GET', 'POST'])]
    public function add(
        Request $request,
        CreateProductService $service,
        FileUploaderInterface $uploader
    ): Response {
        if ($request->isMethod('POST')) {
            $typeValue = $request->request->getString('type');
            $type      = ProductType::tryFrom($typeValue);

            if ($type === null) {
                $this->addFlash('error', 'Type de produit invalide.');
                return $this->redirectToRoute('admin_product_add');
            }

            $imageName = $uploader->upload($request->files->get('image'));

            if ($imageName === null) {
                $this->addFlash('error', 'Veuillez ajouter une image.');
                return $this->redirectToRoute('admin_product_add');
            }

            $service->execute(new CreateProductInput(
                name:        $request->request->getString('name'),
                description: $request->request->getString('description'),
                type:        $type,
                price:       (float) $request->request->get('price'),
                image:       $imageName,
            ));

            $this->addFlash('success', 'Produit ajouté avec succès.');
            return $this->redirectToRoute('admin_products');
        }

        return $this->render('admin/products/add.html.twig', [
            'types' => ProductType::cases(),
        ]);
    }

    #[Route('/edit/{id}', name: 'admin_product_edit', methods: ['GET', 'POST'])]
public function edit(
    int $id,
    Request $request,
    GetProductByIdService $getService,
    UpdateProductService $service,
    FileUploaderInterface $uploader
): Response {
    $product = $getService->execute($id);

        if ($product === null) {
            throw $this->createNotFoundException('Produit introuvable.');
        }

        if ($request->isMethod('POST')) {
            $typeValue = $request->request->getString('type');
            $type      = ProductType::tryFrom($typeValue);

            if ($type === null) {
                $this->addFlash('error', 'Type de produit invalide.');
                return $this->redirectToRoute('admin_product_edit', ['id' => $id]);
            }

            $service->execute(new UpdateProductInput(
                id:          $id,
                name:        $request->request->getString('name'),
                description: $request->request->getString('description'),
                type:        $type,
                price:       (float) $request->request->get('price'),
                image:       $uploader->upload($request->files->get('image')),
            ));

            $this->addFlash('success', 'Produit mis à jour.');
            return $this->redirectToRoute('admin_products');
        }

        return $this->render('admin/products/edit.html.twig', [
            'product' => $product,
            'types'   => ProductType::cases(),
        ]);
    }

    #[Route('/delete/{id}', name: 'admin_product_delete', methods: ['POST'])]
    public function delete(int $id, Request $request, DeleteProductService $service): Response
    {
        if (!$this->isCsrfTokenValid('delete' . $id, $request->request->get('_token'))) {
            throw $this->createAccessDeniedException();
        }

        $service->execute($id);
        $this->addFlash('success', 'Produit supprimé.');
        return $this->redirectToRoute('admin_products');
    }
}