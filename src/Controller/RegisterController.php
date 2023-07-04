<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use symfony\component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;



class RegisterController extends AbstractController
{
    #[Route('/registerRRRRRRRRRRRRRRRRR', name: 'app_registerRRRRRRRRRRRRR')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the plain password
            $plainPassword = $form->get('Mdp')->getData();

            // Hash the password
            $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

            // Set the hashed password on the user entity
            $user->setMdp($hashedPassword);
            $entityManager->persist($user);
            $entityManager->flush();

            // Redirect to a success page or perform any other actions
            return $this->redirectToRoute('app_home');
        }

        return $this->render('register/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/kzefkzfzl', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('front.html.twig', [
            'controller_name' => 'RegisterController',
        ]);
    }
}
