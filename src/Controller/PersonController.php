<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\PersonType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/personne', name: 'person_')]
class PersonController extends AbstractController
{
    #[Route('/nouveau', name: 'create')]
    public function form(Request $request): Response
    {
        $person = new Person();
        $form = $this->createForm(PersonType::class, $person);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dd($person);
        }

        return $this->render('person/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}