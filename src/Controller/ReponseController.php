<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Reponse;
use App\Entity\Utilisateur;
use App\Entity\Vote;
use App\Form\ReponseType;
use App\Repository\QuestionRepository;
use App\Repository\ReponseRepository;
use App\Repository\UtilisateurRepository;
use App\Repository\VoteRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    #[Route('/reponse/affichervisitor/{question}', name: 'afficherreponsevisitor')]
    public function afficherreponsevisitor(ManagerRegistry $doctrine, Request $request, QuestionRepository $repo, $question, ReponseRepository $repository): Response
    {

        $question1 = $repo->getbyname($question);
        $reponses = $repository->getbyidquest($question1->getIdQ());


        return $this->render('reponse/afficherallReponseVisitor.html.twig', [

            'r' => $reponses,
            'id' => $question1->getIdQ()

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

    #[Route('/update-vote', name: 'update_vote')]
    public function updateVote(Request $request, QuestionRepository $repoquest, ManagerRegistry $doctrine, VoteRepository $voterepo): JsonResponse
    {
        $out = new ConsoleOutput();
        $vote = new Vote();
        $user = $this->security->getUser();
        if ($user instanceof Utilisateur) {
            $idU = $user;
        }
        if ($request->isMethod('POST')) {
            $question = $request->request->get('question');
            $action = $request->request->get('action');
            $out->writeln($question);
            $out->writeln($action);
            // Retrieve the question from the database
            $questionEntity = $repoquest->getbyname($question);

            $out->writeln($questionEntity->getIdQ());

            if ($questionEntity == null) {
                return new JsonResponse(['error' => 'Question not found'], 404);
            }

            // Update the vote count based on the action (up or down)
            if ($action === 'up') {
                $questionEntity->setVoteQ($questionEntity->getVoteQ() + 1);
                $vote->setIdQ($questionEntity);
                $vote->setIdR(null);
                $vote->setIdU($idU);
                $vote->setTypeVote('up');
                $voterepo->save($vote, true);
            } elseif ($action === 'down') {
                $questionEntity->setVoteQ($questionEntity->getVoteQ() - 1);
                $vote->setIdQ($questionEntity);
                $vote->setIdR(null);
                $vote->setIdU($idU);
                $vote->setTypeVote('down');
                $voterepo->save($vote, true);
            } else {
                return new JsonResponse(['error' => 'Invalid action'], 400);
            }

            // Persist the changes to the database
            $entityManager = $doctrine->getManager();
            $entityManager->flush();
        }

        // Return the updated vote count in the response
        return new JsonResponse(['voteCount' => $questionEntity->getVoteQ()]);
    }
    #[Route('/update-voterep', name: 'update_voterep')]
    public function updateVoterep(Request $request, ReponseRepository $reporep, ManagerRegistry $doctrine): JsonResponse
    {
        $out = new ConsoleOutput();
        if ($request->isMethod('POST')) {
            $reponse = $request->request->get('reponse');
            $action = $request->request->get('action');
            $out->writeln($reponse);
            $out->writeln($action);
            // Retrieve the reponse from the database
            $reponseEntity = $reporep->getbyiduniq($reponse);

            $out->writeln($reponseEntity->getIdR());

            if ($reponseEntity == null) {
                return new JsonResponse(['error' => 'Question not found'], 404);
            }

            // Update the vote count based on the action (up or down)
            if ($action === 'up') {
                $reponseEntity->setVoteR($reponseEntity->getVoteR() + 1);
            } elseif ($action === 'down') {
                $reponseEntity->setVoteR($reponseEntity->getVoteR() - 1);
            } else {
                return new JsonResponse(['error' => 'Invalid action'], 400);
            }

            // Persist the changes to the database
            $entityManager = $doctrine->getManager();
            $entityManager->flush();
        }

        // Return the updated vote count in the response
        return new JsonResponse(['voteCount' => $reponseEntity->getVoteR()]);
    }
}
