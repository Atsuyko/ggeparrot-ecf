<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Entity\Contact;
use App\Entity\User;
use App\Entity\Option;
use App\Entity\Service;
use App\Entity\OpeningTime;
use App\Entity\Opinion;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Garage V.PARROT')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-house');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Annonces', 'fa fa-car', Car::class);
        yield MenuItem::linkToCrud('Options', 'fa fa-gear', Option::class);
        yield MenuItem::linkToCrud('Services', 'fa fa-clipboard', Service::class);
        yield MenuItem::linkToCrud('Horaires', 'fa fa-clock', OpeningTime::class);
        yield MenuItem::linkToCrud('Avis', 'fa fa-comment', Opinion::class);
        yield MenuItem::linkToCrud('Contacts', 'fa fa-envelope', Contact::class);
    }
}
