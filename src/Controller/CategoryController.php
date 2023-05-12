<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categorie', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/nouveau', name: 'create')]
    public function form(): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        return $this->render('category/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
