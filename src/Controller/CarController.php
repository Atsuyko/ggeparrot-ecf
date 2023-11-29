<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OpeningTimeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class CarController extends AbstractController
{
    #[Route('/annonces', name: 'car')]
    public function index(OpeningTimeRepository $openingTimeRepository, CarRepository $carRepository): Response
    {
        $cars = $carRepository->findAll();

        return $this->render('car/index.html.twig', [
            'openingTimes' => $openingTimeRepository->findAll(),
            'cars' => $cars
        ]);
    }

    #[Route('/annonces/show/{id}', name: 'car.show')]
    public function show(OpeningTimeRepository $openingTimeRepository, Car $car, Request $request, EntityManagerInterface $em): Response
    {
        $contact = new Contact();
        $contact->setCar($car);

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $em->persist($contact);
            $em->flush();
        }

        return $this->render('car/show.html.twig', [
            'openingTimes' => $openingTimeRepository->findAll(),
            'car' => $car,
            'form' => $form->createView()
        ]);
    }

    #[Route('/annonce/nouvelle', name: 'car.new')]
    public function new(OpeningTimeRepository $openingTimeRepository, Request $request, EntityManagerInterface $em, SluggerInterface $slugger)
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();

            $teaserImg = $form->get('teaserImg')->getData();
            $originalFilename = pathinfo($teaserImg->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $teaserImg->guessExtension();
            try {
                $teaserImg->move(
                    $this->getParameter('uploads_dir'),
                    $newFilename
                );
            } catch (FileException $e) {
            }

            $car->setTeaserImg($newFilename);

            $img1 = $form->get('img1')->getData();
            $originalFilename = pathinfo($img1->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $img1->guessExtension();
            try {
                $img1->move(
                    $this->getParameter('uploads_dir'),
                    $newFilename
                );
            } catch (FileException $e) {
            }

            $car->setImg1($newFilename);

            $img2 = $form->get('img2')->getData();
            $originalFilename = pathinfo($img2->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $img2->guessExtension();
            try {
                $img2->move(
                    $this->getParameter('uploads_dir'),
                    $newFilename
                );
            } catch (FileException $e) {
            }

            $car->setImg2($newFilename);

            $img3 = $form->get('img3')->getData();
            $originalFilename = pathinfo($img3->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $img3->guessExtension();
            try {
                $img3->move(
                    $this->getParameter('uploads_dir'),
                    $newFilename
                );
            } catch (FileException $e) {
            }

            $car->setImg3($newFilename);

            $em->persist($car);
            $em->flush();

            $this->addFlash(
                'primary',
                'La nouvelle annonce à bien été enregistrer.'
            );

            return $this->redirectToRoute('car');
        }

        return $this->render('car/new.html.twig', [
            'openingTimes' => $openingTimeRepository->findAll(),
            'form' => $form->createView()
        ]);
    }

    #[Route('/annonce/modifier/{id}', name: 'car.edit')]
    public function edit(OpeningTimeRepository $openingTimeRepository, Request $request, EntityManagerInterface $em, SluggerInterface $slugger, Car $car)
    {
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();

            $teaserImg = $form->get('teaserImg')->getData();
            $originalFilename = pathinfo($teaserImg->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $teaserImg->guessExtension();
            try {
                $teaserImg->move(
                    $this->getParameter('uploads_dir'),
                    $newFilename
                );
            } catch (FileException $e) {
            }

            $car->setTeaserImg($newFilename);

            $img1 = $form->get('img1')->getData();
            $originalFilename = pathinfo($img1->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $img1->guessExtension();
            try {
                $img1->move(
                    $this->getParameter('uploads_dir'),
                    $newFilename
                );
            } catch (FileException $e) {
            }

            $car->setImg1($newFilename);

            $img2 = $form->get('img2')->getData();
            $originalFilename = pathinfo($img2->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $img2->guessExtension();
            try {
                $img2->move(
                    $this->getParameter('uploads_dir'),
                    $newFilename
                );
            } catch (FileException $e) {
            }

            $car->setImg2($newFilename);

            $img3 = $form->get('img3')->getData();
            $originalFilename = pathinfo($img3->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $img3->guessExtension();
            try {
                $img3->move(
                    $this->getParameter('uploads_dir'),
                    $newFilename
                );
            } catch (FileException $e) {
            }

            $car->setImg3($newFilename);

            $em->persist($car);
            $em->flush();

            $this->addFlash(
                'primary',
                'L\'annonce à bien été modifiée.'
            );

            return $this->redirectToRoute('car');
        }

        return $this->render('car/edit.html.twig', [
            'openingTimes' => $openingTimeRepository->findAll(),
            'form' => $form->createView(),
            'car' => $car
        ]);
    }

    #[Route('/car/delete/{id}', name: 'car.delete')]
    public function delete(Car $car, EntityManagerInterface $em): Response
    {
        $em->remove($car);
        $em->flush();

        $this->addFlash(
            'primary',
            'L\'annonce à bien été supprimée.'
        );

        return $this->redirectToRoute('car');
    }
}
