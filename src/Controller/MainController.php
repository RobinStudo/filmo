<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController
{
    #[Route('/', 'main_index')]
    public function index(): Response
    {
        return new Response('Hello World!');
    }

    #[Route('/blog', 'main_blog')]
    public function blog(): Response
    {
        return new Response('Hello Blog!');
    }

    // TODO - Créer 3 routes pour la page de contact, la page A propos, la page de liste des films
}
