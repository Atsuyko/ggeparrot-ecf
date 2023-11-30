<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Form\SearchType;
use App\Model\SearchData;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OpeningTimeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class CarController extends AbstractController
{
    /**
     * Display all cars announces and display opening time on footer
     *
     * @param OpeningTimeRepository $openingTimeRepository
     * @param CarRepository $carRepository
     * @return Response
     */
    #[Route('/annonces', name: 'car')]
    public function index(OpeningTimeRepository $openingTimeRepository, CarRepository $carRepository, Request $request): Response
    {
        $searchData = new SearchData();
        $form = $this->createForm(SearchType::class, $searchData);
        $form->handleRequest($request);

        [$minPrice, $maxPrice, $minKm, $maxKm, $minYear, $maxYear] = $carRepository->findMinMax($searchData);

        $cars = $carRepository->findBySearch($searchData);

        return $this->render('car/index.html.twig', [
            'openingTimes' => $openingTimeRepository->findAll(),
            'cars' => $cars,
            'form' => $form->createView(),
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'minKm' => $minKm,
            'maxKm' => $maxKm,
            'minYear' => $minYear,
            'maxYear' => $maxYear,
        ]);
    }

    /**
     * Display one car announce
     *
     * @param OpeningTimeRepository $openingTimeRepository
     * @param Car $car
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route('/annonces/show/{id}', name: 'car.show')]
    public function show(OpeningTimeRepository $openingTimeRepository, Car $car, Request $request, EntityManagerInterface $em): Response
    {
        $contact = new Contact();
        $contact->setCar($car)->setSubject('Renseignement annonce N° ' . $car->getId() . ' ' . $car->getBrand() . ' ' . $car->getModel());

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $em->persist($contact);
            $em->flush();

            return $this->redirectToRoute('car');
        }

        return $this->render('car/show.html.twig', [
            'openingTimes' => $openingTimeRepository->findAll(),
            'car' => $car,
            'form' => $form->createView()
        ]);
    }

    /**
     * Create a new announce
     *
     * @param OpeningTimeRepository $openingTimeRepository
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param SluggerInterface $slugger
     * @return void
     */
    #[Route('/annonce/nouvelle', name: 'car.new')]
    #[IsGranted('ROLE_USER')]
    public function new(OpeningTimeRepository $openingTimeRepository, Request $request, EntityManagerInterface $em, SluggerInterface $slugger)
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $car = $form->getData();

            // Take the upload file name, rename and safe it before save in DB
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

    /**
     * Update an announce
     *
     * @param OpeningTimeRepository $openingTimeRepository
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param SluggerInterface $slugger
     * @param Car $car
     * @return void
     */
    #[Route('/annonce/modifier/{id}', name: 'car.edit')]
    #[IsGranted('ROLE_USER')]
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

    /**
     * Delete an announce
     *
     * @param Car $car
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route('/car/delete/{id}', name: 'car.delete')]
    #[IsGranted('ROLE_USER')]
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
