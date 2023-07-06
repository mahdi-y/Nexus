<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\ChangePasswordFormType;
use App\Form\ModifierType;
use App\Form\ResetpasswordType;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Security\AppCustomAuthenticator;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPassworEncoderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class ProfileController extends AbstractController
{ public $mailerService;

    public function __construct(MailerService $mailerService)
    {
        $this->mailerService = $mailerService;
    }
   
    #[Route('/profile', name: 'app_profile')]
    public function index(MailerService $mailerService): Response
    {       
         $mailerService->sendConfirmationEmail('nexus.vermeg@gmail.com', 'nomU');
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }
   
     /**
 * @Route("/modifier", name="app_modifier")
 */
public function editProfile(Request $request, EntityManagerInterface $entityManager)
{
    $user = $this->getUser();
    $form = $this->createForm(ModifierType::class, $user);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('message', 'Profil mis à jour');
        
    }

    return $this->render('profile/modifier/index1.html.twig', [
        'ModifierType' => $form->createView(),
    ]);
}
    
    
#[Route('/delete/{id}', name: 'user.delete')]
public function deleteUtilisateurs($id, ManagerRegistry $doctrine): Response
{
    $em = $doctrine->getManager();
    $repo = $em->getRepository(Utilisateur::class);
    $utilisateur = $repo->find($id);
    // Clear user's authentication token
    $this->get('security.token_storage')->setToken(null);

    if ($utilisateur instanceof Utilisateur) {
        $em->remove($utilisateur);
        $em->flush();

        $this->addFlash('success', 'Utilisateur supprimé avec succès');
    } else {
        $this->addFlash('error', 'Utilisateur introuvable');
    }

    return $this->redirectToRoute('landingpage');
}


   
    #[Route('/edition-mot-de-passe/{id}', name: 'user.edit.password', methods: ['GET', 'POST'])]
public function editPassword(
    int $id,
    Request $request,
    EntityManagerInterface $manager,
    UserPasswordHasherInterface $hasher,
    UtilisateurRepository $userRepository
): Response {
    $user = $userRepository->find($id);

    if (!$user) {
        throw $this->createNotFoundException('User not found');
    }

    $form = $this->createForm(ChangePasswordFormType::class);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        if ($hasher->isPasswordValid($user, $form->getData()['plainPassword'])) {
            $hashedPassword = $hasher->hashPassword($user, $form->getData()['newPassword']);
            $user->setMdp($hashedPassword);

            $this->addFlash(
                'success',
                'Le mot de passe a été modifié.'
            );

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('login');
        } else {
            $this->addFlash(
                'warning',
                'Le mot de passe renseigné est incorrect.'
            );
        }
    }

    return $this->render('profile/modifier/index2.html.twig', [
        'form2' => $form->createView()
    ]);
}
 
/**
* @Route("/confirm-email/{email}", name="confirm_email")
*/
public function confirmEmail($email,Request $request, EntityManagerInterface $em): Response
{
    $repo = $em->getRepository(Utilisateur::class);
    $utilisateur = $repo->findOneBy(['emailU' => $email]);
    // If the user is found, update the 'verifi' field
    if ($utilisateur instanceof Utilisateur) {
        $utilisateur->setVerifieU(1);

        // Persist the changes to the database
        $em->flush();

        // TODO: Redirect to a success page or perform other actions
        return $this->render('blank.html.twig');
    }

   

   // TODO: Redirect to an error page or perform other actions
   return $this->render('blank.html.twig');
}
#[Route('/reset', name: 'app_reset')]
public function i(MailerService $mailerService, Request $request): Response
{
    if ($request->isMethod('POST')) {
        // Get the form data
        $email = $request->request->get('email');
        $mailerService->sendReset($email);
        
        // Redirect to the login page
        return new RedirectResponse($this->generateUrl('login'));
    }
    
    return $this->render('reset/email.html.twig', [
        'controller_name' => 'ProfileController',
    ]);
}
#[Route('/edition-mot-de-passe1/{email}', name: 'user.edit.password1', methods: ['GET', 'POST'])]
public function editPassword1(
    string $email,
    Request $request,
    EntityManagerInterface $manager,
    UserPasswordHasherInterface $hasher,
    UtilisateurRepository $userRepository,
    
): Response {
    $user = $userRepository->findOneBy(['emailU' => $email]);


    $form = $this->createForm(ResetpasswordType::class);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $hashedPassword = $hasher->hashPassword($user, $form->getData()['newPassword']);
        $user->setMdp($hashedPassword);

        $this->addFlash(
            'success',
            'Le mot de passe a été modifié.'
        );

        $manager->persist($user);
        $manager->flush();

        return $this->redirectToRoute('login');
    }

    return $this->render('profile/modifier/modif.html.twig', [
        'form3' => $form->createView(),
        'email'=>$email,
    ]);
}}

