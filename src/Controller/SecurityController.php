<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use DateTimeImmutable;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Google\GoogleAuthenticatorInterface;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Google\GoogleAuthenticatorTwoFactorProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\HttpUtils;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Scheb\TwoFactorBundle\Model\Google\TwoFactorInterface as GoogleAuthenticatorTwoFactorInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SecurityController extends AbstractController
{
    /**

     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // Get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // Get the last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(Request $request, LogoutSuccessHandlerInterface $logoutSuccessHandler)
    {
        // This method will not be executed.
        throw new \Exception('This should not be reached.');
    }
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, MailerService $mailer, GoogleAuthenticatorInterface $authentificator)
    {
        if ($request->isMethod('POST')) {
            $secret =  $authentificator->generateSecret();


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
            $utilisateur->setGoogleAuthenticatorSecret($secret);

            // Hash the password
            $encodedPassword = $passwordEncoder->encodePassword($utilisateur, $password);
            $utilisateur->setMdp($encodedPassword);

            // Save the utilisateur to the database

            $entityManager->persist($utilisateur);
            $entityManager->flush();

            // Redirect to the login page
            $mailer->sendConfirmationEmail($email, $nom);


            return $this->redirectToRoute('landingpage');
        }

        return $this->render('security/register.html.twig');
    }

    /**
     * @Route("/2fa", name="2fa_login")
     */
    public function check2fa(GoogleAuthenticatorInterface $authentificator, TokenStorageInterface $storage)
    {
        $user = $storage->getToken()->getUser();
        if (!($user instanceof GoogleAuthenticatorTwoFactorInterface)) {
            throw new NotFoundHttpException('Cannot display QR code');
        }
        $code = $authentificator->getQRContent($user);
        $qrcode = "https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=" . $code;
        return $this->render('Security/2fa_login.html.twig', [
            'qrcode' => $qrcode
        ]);
    }
}
