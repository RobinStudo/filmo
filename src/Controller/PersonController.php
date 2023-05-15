<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\PersonType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/personne', name: 'person_')]
class PersonController extends AbstractController
{
    #[Route('/nouveau', name: 'create')]
    public function form(EntityManagerInterface $em, Request $request): Response
    {
        $person = new Person();
        $form = $this->createForm(PersonType::class, $person);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($person);
            $em->flush();

            $this->addFlash('notice', 'La personne a bien été créée');
            return $this->redirectToRoute('person_create');
        }

        return $this->render('person/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
