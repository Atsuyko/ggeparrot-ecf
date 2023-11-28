<?php

namespace App\Controller;

use App\Repository\OpeningTimeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PolicyController extends AbstractController
{
    #[Route('/politique-de-conficentialité', name: 'policy')]
    public function index(OpeningTimeRepository $openingTimeRepository): Response
    {
        return $this->render('policy/index.html.twig', [
            'openingTimes' => $openingTimeRepository->findAll(),
        ]);
    }
}
