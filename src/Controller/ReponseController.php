<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Reponse;
use App\Entity\Utilisateur;
use App\Form\ReponseType;
use App\Repository\QuestionRepository;
use App\Repository\ReponseRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ReponseController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }



    #[Route('/reponse', name: 'app_reponse')]
    public function index(): Response
    {
        return $this->render('reponse/index.html.twig', [
            'controller_name' => 'ReponseController',
        ]);
    }
    #[Route('/reponse/add/{id}', name: 'reponseadd')]
    public function reponseadd($id, ManagerRegistry $doctrine, Request $req, UtilisateurRepository $utirep, QuestionRepository $quesrep): Response
    {
        $user = $this->security->getUser();
        $date = new \DateTime('@' . strtotime('now'));
        $em = $doctrine->getManager();
        $question = new Question();
        $question = $quesrep->find($id);
        $reponse = new Reponse();
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $reponse->setDateAjoutR($date);
            $reponse->setEtatR(0);
            $reponse->setVoteR(0);
            $reponse->setSignaleR(0);
            $reponse->setIdQ($question);
            $reponse->setIdU($user);
            $em->persist($reponse);
            $em->flush();
            return $this->redirectToRoute('afficherreponseUC');
        }

        return $this->renderForm('reponse/addReponse.html.twig', ['f' => $form]);
    }
    #[Route('/reponse/afficherUC', name: 'afficherreponseUC')]
    public function afficherreponseall(ManagerRegistry $doctrine, Request $request, ReponseRepository $repository): Response
    {
        $user = $this->security->getUser();
        if ($user instanceof Utilisateur) {
            $reponses = $repository->getbyid($user->getIdU());
        }
        return $this->render('reponse/afficher_reponse1.html.twig', [

            'r' => $reponses
        ]);
    }
    #[Route('/reponse/afficher/{question}', name: 'afficherreponse')]
    public function afficherreponse(ManagerRegistry $doctrine, Request $request, QuestionRepository $repo, $question, ReponseRepository $repository): Response
    {

        $question1 = $repo->getbyname($question);
        $reponses = $repository->getbyidquest($question1->getIdQ());
        $user = $this->security->getUser();
        if ($user instanceof Utilisateur) {
            $idU = $user->getIdU();
        }

        return $this->render('reponse/afficherallReponse.html.twig', [

            'r' => $reponses,
            'id' => $question1->getIdQ(),
            'idU' => $idU
        ]);
    }
    #[Route('/reponse/afficher/{id}', name: 'afficherreponse1')]
    public function afficherreponse1($id, ManagerRegistry $doctrine, Request $request, ReponseRepository $repository, QuestionRepository $repo): Response
    {

        $reponses = $repository->getbyid($id);
        return $this->render('reponse/afficher_reponse1.html.twig', [

            'r' => $reponses
        ]);
    }
    #[Route('/reponse/modifier/{id}', name: 'modifierreponse')]
    public function modifierreponse($id, ManagerRegistry $doctrine, Request $request, UtilisateurRepository $utirep, QuestionRepository $quesrep, ReponseRepository $repo): Response
    {
        $user = $this->security->getUser();
        $reponses = $repo->find($id);
        $form = $this->createForm(ReponseType::class, $reponses);
        $form->handleRequest($request);
        $date = new \DateTime('@' . strtotime('now'));
        if ($form->isSubmitted() && $form->isValid()) {
            $reponses->setDateAjoutR($date);
            $reponses->setEtatR(0);
            $reponses->setVoteR(0);
            $reponses->setSignaleR(0);
            $reponses->setIdU($user);
            $manager = $doctrine->getManager();



            $manager->flush();


            return $this->redirectToRoute('afficherreponseUC');
        }

        return $this->render('reponse/updateReponse.html.twig', ['f' => $form->createView()]);
    }
    #[Route('/reponse/supprimer/{id}', name: 'supprimerreponse')]
    public function supprimerreponse($id, ManagerRegistry $doctrine, ReponseRepository $repo): Response
    {
        $reponse = $repo->find($id);
        $manager = $doctrine->getManager();
        $manager->remove($reponse);
        $manager->flush();

        return $this->redirectToRoute('afficherreponseUC');
    }
}
