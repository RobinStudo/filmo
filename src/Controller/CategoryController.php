<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categorie', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/nouveau', name: 'create')]
    #[Route('/{id}/editer', name: 'edit', requirements: ['id' => '\d+'])]
    public function form(
        CategoryRepository $categoryRepository,
        EntityManagerInterface $em,
        Request $request,
        int $id = null
    ): Response {
        if ($id !== null) {
            $category = $categoryRepository->find($id);
            $isNew = false;
        } else {
            $category = new Category();
            $isNew = true;
        }

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();

            $verb = $isNew ? 'créée' : 'modifiée';
            $this->addFlash('notice', 'La catégorie a bien été ' . $verb);
            return $this->redirectToRoute('category_create');
        }

        return $this->render('category/form.html.twig', [
            'form' => $form->createView(),
            'is_new' => $isNew,
        ]);
    }
}
