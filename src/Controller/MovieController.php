<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/films', 'movie_')]
class MovieController
{
    #[Route('', 'list')]
    public function list(): Response
    {
        return new Response('Page liste des films');
    }
}
