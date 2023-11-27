<?php

namespace App\Controller;

use App\Repository\OpeningTimeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmployeeController extends AbstractController
{
    #[Route('/employee', name: 'employee')]
    public function index(OpeningTimeRepository $openingTimeRepository): Response
    {
        return $this->render('employee/index.html.twig', [
            'openingTimes' => $openingTimeRepository->findAll(),
        ]);
    }
}
