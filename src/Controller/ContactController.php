<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OpeningTimeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function new(OpeningTimeRepository $openingTimeRepository, Request $request, EntityManagerInterface $em): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $em->persist($contact);
            $em->flush();

            $this->addFlash(
                'primary',
                'Nous vous remercions pour votre message, notre équipe vous répondra dans les meilleurs délais.'
            );

            return $this->redirectToRoute('home');
        }

        return $this->render('contact/new.html.twig', [
            'openingTimes' => $openingTimeRepository->findAll(),
            'form' => $form->createView()
        ]);
    }
}
