<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/films', 'movie_')]
class MovieController extends AbstractController
{
    private MovieRepository $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    #[Route('', 'list')]
    public function list(): Response
    {
        $movies = $this->movieRepository->findAll();

        return $this->render('movie/list.html.twig', [
            'movies' => $movies,
        ]);
    }

    #[Route('/{id}', 'view', ['id' => '\d+'])]
    public function view(int $id): Response
    {
        $movie = $this->movieRepository->find($id);

        if ($movie === null) {
            throw new NotFoundHttpException();
        }

        return $this->render('movie/view.html.twig', [
            'movie' => $movie,
        ]);
    }

    #[Route('/nouveau', 'create')]
    #[Route('/{id}/editer', 'edit', ['id' => '\d+'])]
    public function form(): Response
    {
        return new Response('Page de formulaire de film');
    }

    #[Route('/{id}/supprimer', 'delete', ['id' => '\d+'])]
    public function delete(EntityManagerInterface $em, Movie $movie): Response
    {
        $em->remove($movie);
        $em->flush();

        $this->addFlash('notice', 'Le film a bien été supprimé');
        return $this->redirectToRoute('movie_list');
    }
}
