<?php

namespace App\Controller;

use App\Entity\Opinion;
use App\Form\OpinionType;
use App\Repository\OpeningTimeRepository;
use App\Repository\OpinionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * Display home / Display opinions 
     * Create an opinion
     *
     * @param OpinionRepository $opinionRepository
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param OpeningTimeRepository $openingTimeRepository
     * @return Response
     */
    #[Route('/', name: 'home')]
    public function index(OpinionRepository $opinionRepository, Request $request, EntityManagerInterface $em, OpeningTimeRepository $openingTimeRepository): Response
    {
        $opinions = $opinionRepository->findAll();

        $newOpinion = new Opinion();
        $newOpinion->setIsValidate(false);

        $form = $this->createForm(OpinionType::class, $newOpinion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newOpinion = $form->getData();

            $em->persist($newOpinion);
            $em->flush();

            $this->addFlash(
                'primary',
                'Votre avis à bien été enrisgitré, il sera visible prochainement'
            );

            return $this->redirectToRoute('home');
        }

        return $this->render('home/index.html.twig', [
            'openingTimes' => $openingTimeRepository->findAll(),
            'opinions' => $opinions,
            'form' => $form->createView()
        ]);
    }
}
