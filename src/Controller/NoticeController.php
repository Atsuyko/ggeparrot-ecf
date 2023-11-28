<?php

namespace App\Controller;

use App\Repository\OpeningTimeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NoticeController extends AbstractController
{
    #[Route('/mentions-légales', name: 'notice')]
    public function index(OpeningTimeRepository $openingTimeRepository): Response
    {
        return $this->render('notice/index.html.twig', [
            'openingTimes' => $openingTimeRepository->findAll(),
        ]);
    }
}
