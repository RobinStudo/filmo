<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/films', 'movie_')]
class MovieController extends AbstractController
{
    #[Route('', 'list')]
    public function list(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAll();

        // TODO
        // 6 - (bonus) Mettre en forme l'affichage

        return $this->render('movie/list.html.twig', [
            'movies' => $movies,
        ]);
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
