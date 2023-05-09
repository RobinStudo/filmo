<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/films', 'movie_')]
class MovieController extends AbstractController
{
    #[Route('', 'list')]
    public function list(): Response
    {
        return new Response('Page liste des films');
    }

    #[Route('/{id}', 'view', ['id' => '\d+'])]
    public function view(): Response
    {
        return new Response('Page de vue film');
    }

    #[Route('/nouveau', 'create')]
    #[Route('/{id}/editer', 'edit', ['id' => '\d+'])]
    public function form(): Response
    {
        return new Response('Page de formulaire de film');
    }

    #[Route('/{id}/supprimer', 'delete', ['id' => '\d+'])]
    public function delete(): Response
    {
        return new Response('Page de suppression film');
    }
}
