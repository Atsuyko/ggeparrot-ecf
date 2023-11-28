<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OpeningTimeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/user/password/{id}', name: 'user.password', methods: ['GET', 'POST'])]
    public function editPassword(OpeningTimeRepository $openingTimeRepository, User $user, Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login');
        }

        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('home');
        }

        $form = $this->createForm(UserPasswordType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($userPasswordHasher->isPasswordValid($user, $form->getData()['password'])) {
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->getData()['newPassword']
                    )
                );

                $em->persist($user);
                $em->flush();

                $this->addFlash(
                    'primary',
                    'Votre mot de passe à bien été modifié.'
                );

                return $this->redirectToRoute('home');
            } else {
                $this->addFlash(
                    'primary',
                    'Votre mot de passe est incorrect.'
                );
            }
        }

        return $this->render('user/password.html.twig', [
            'openingTimes' => $openingTimeRepository->findAll(),
            'form' => $form->createView()
        ]);
    }
}
