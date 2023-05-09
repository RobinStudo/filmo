<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('', 'main_')]
class MainController
{
    #[Route('/', 'index')]
    public function index(): Response
    {
        return new Response('Hello World!');
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
