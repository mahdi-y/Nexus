<?php

namespace App\Controller;

use App\Form\LoginFormType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, Request $request)
    {
        $form = $this->createForm(LoginFormType::class);

        // Handle form submission
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Retrieve the submitted form data
            $formData = $form->getData();

            // Perform authentication and login logic here

            // Redirect the user after successful login
            return $this->redirectToRoute('app_home');
        }

        return $this->render('security/login.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
<<<<<<< Updated upstream
        // This method can be empty because it will be intercepted by the logout key on your firewall
        throw new \Exception('This method should not be called directly.');
=======
        // This method will not be executed.
        throw new \Exception('This should not be reached.');
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();

            // Get the form data
            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');
            $email = $request->request->get('email');
            $DOB = $request->request->get('DateDeNaissance');
            $sexe = $request->request->get('sexe');
            $password = $request->request->get('password');

            //convert date from string to datetimeinterface 
            $DOB = DateTimeImmutable::createFromFormat('Y-m-d', $DOB);


            // Create a new Utilisateur object
            $utilisateur = new Utilisateur();
            $utilisateur->setNomU($nom);
            $utilisateur->setPrenomU($prenom);
            $utilisateur->setEmailU($email);
            $utilisateur->setDateNaissanceU($DOB);
            $utilisateur->setSexeU($sexe);

            // Hash the password
            $encodedPassword = $passwordEncoder->encodePassword($utilisateur, $password);
            $utilisateur->setMdp($encodedPassword);

            // Save the utilisateur to the database
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            // Redirect to the landingpage page
            return $this->redirectToRoute('landingpage');
        }

        return $this->render('security/register.html.twig');
>>>>>>> Stashed changes
    }
}
