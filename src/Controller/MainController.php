<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('', 'main_')]
class MainController extends AbstractController
{
    #[Route('/', 'index')]
    public function index(): Response
    {
        $sentence = 'Bienvenue sur';
        $appName = 'Filmo';
        return $this->render('main/index.html.twig', [
            'sentence' => $sentence,
            'name' => $appName,
        ]);
    }

    #[Route('/contact', 'contact')]
    public function contact(): Response
    {
        return new Response('Page de contact');
    }

    #[Route('/a-propos', 'about')]
    public function about(): Response
    {
        return new Response('Page A propos');
    }
}
