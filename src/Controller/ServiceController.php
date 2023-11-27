<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use App\Repository\OpeningTimeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceController extends AbstractController
{
    #[Route('/service', name: 'service')]
    public function index(ServiceRepository $serviceRepository, OpeningTimeRepository $openingTimeRepository): Response
    {
        $services = $serviceRepository->findAll();

        return $this->render('service/index.html.twig', [
            'openingTimes' => $openingTimeRepository->findAll(),
            'services' => $services
        ]);
    }
}
