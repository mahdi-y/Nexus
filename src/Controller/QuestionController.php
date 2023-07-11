<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Utilisateur;
use App\Entity\Vote;
use App\Form\QuestionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\QuestionRepository;
use App\Repository\VoteRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;




class QuestionController extends AbstractController
{
    #[Route('/question', name: 'app_question', methods: ['GET', 'POST'])]
    public function question(Request $request, ManagerRegistry $doctrine, Security $security): Response
{
    $date = new \DateTime('@' . strtotime('now'));
    $user = $security->getUser();

    if (!$user instanceof Utilisateur) {
        throw new AccessDeniedException('User must be logged in.');
    }

    $question = new Question();
    $question->setIdU($user); // Set the idU value for the logged-in user

    $form = $this->createForm(QuestionType::class, $question);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $doctrine->getManager();
        $question->setDateAjoutQ($date);
        $entityManager->persist($question);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }

    return $this->render('question/index.html.twig', [
        'questionForm' => $form->createView(),
    ]);
}

    
    
    #[Route('/my_questions', name: 'app_my_questions', methods: ['GET'])]
public function myQuestions(Security $security, QuestionRepository $questionRepository): Response
{
    
    $user = $security->getUser();
    
    $questions = $questionRepository->findByUser($user);

    return $this->render('question/my_questions.html.twig', [
        'questions' => $questions,
    ]);
    
}
#[Route('/question/{id}/edit', name: 'app_question_edit', methods: ['GET', 'POST'])]
public function editQuestion(Request $request, EntityManagerInterface $entityManager, $id): Response
{
    $question = $entityManager->getRepository(Question::class)->find($id);

    if (!$question) {
        throw $this->createNotFoundException('Question not found.');
    }

    // Create the form and handle the request
    $form = $this->createForm(QuestionType::class, $question);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Persist the changes to the database
        $entityManager->flush();

        // Redirect to a success page or any other desired action
        return $this->redirectToRoute('app_my_questions');
    }

    return $this->render('question/edit.html.twig', [
        'questionForm' => $form->createView(),
    ]);
}

#[Route('/question/{id}/delete', name: 'app_question_delete', methods: ['POST'])]
public function deleteQuestion(EntityManagerInterface $entityManager, $id): Response
{
    $question = $entityManager->getRepository(Question::class)->find($id);

    if (!$question) {
        throw $this->createNotFoundException('Question not found.');
    }

    // Delete the question
    $entityManager->remove($question);
    $entityManager->flush();

    // Redirect to a success page or any other desired action
    return $this->redirectToRoute('app_my_questions');
}

// ...

#[Route('/question/{id}/vote', name: 'app_question_vote', methods: ['POST'])]
public function voteQuestion(Request $request, EntityManagerInterface $entityManager, VoteRepository $voteRepository, $id): Response
{
    $question = $entityManager->getRepository(Question::class)->find($id);

    if (!$question) {
        throw $this->createNotFoundException('Question not found.');
    }

    // Retrieve the currently logged-in user
    $user = $this->getUser();

    // Check if the user has already voted on this question
    $existingVote = $voteRepository->findOneBy(['IdQ' => $question, 'IdU' => $user]);

    // Retrieve the vote type from the request
    $voteType = $request->request->get('voteType');

    // Check if the user has already voted on this question
    if ($existingVote) {
        $existingVoteType = $existingVote->getVoteType();

        // Compare the existing vote type with the new vote type
        if ($existingVoteType === $voteType) {
            // User has already voted with the same vote type, do nothing
            return $this->redirectToRoute('app_my_questions');
        }

        // Update the vote count based on the switch in vote type
        if ($existingVoteType === 'upvote') {
            $question->setVoteQ($question->getVoteQ() - 1);
        } elseif ($existingVoteType === 'downvote') {
            $question->setVoteQ($question->getVoteQ() + 1);
        }

        // Update the existing vote with the new vote type
        $existingVote->setVoteType($voteType);
        $entityManager->flush();

        // Update the vote count on the page
        $response = (string) $question->getVoteQ();
    } else {
        // User has not voted on this question before, proceed with adding a new vote

        // Perform the vote update based on the vote type
        if ($voteType === 'upvote') {
            $question->setVoteQ($question->getVoteQ() + 1);
        } elseif ($voteType === 'downvote') {
            $question->setVoteQ($question->getVoteQ() - 1);
        } else {
            // Invalid vote type, return an error response
            return new Response('Invalid vote type.', Response::HTTP_BAD_REQUEST);
        }

        // Create a new Vote entity and associate it with the question and user
        $vote = new Vote();
        $vote->setQuestion($question);
        $vote->setUtilisateur($user);
        $vote->setVoteType($voteType);

        $entityManager->persist($vote);
        $entityManager->flush();

        // Update the vote count on the page
        $response = (string) $question->getVoteQ();
    }

    // Return the updated vote count as the response
    return new Response($response, Response::HTTP_OK);
}
#[Route('/question/{id}/report', name: 'app_question_report', methods: ['POST'])]
public function reportQuestion(EntityManagerInterface $entityManager, QuestionRepository $questionRepository, $id): Response
{
    $question = $questionRepository->find($id);

    if (!$question) {
        throw $this->createNotFoundException('Question not found.');
    }

    // Increment the 'Signale_Q' column
    $question->setSignaleQ($question->getSignaleQ() + 1);
    $entityManager->flush();

    // Return a success response
    return new Response('Question reported successfully!', Response::HTTP_OK);
}

#[Route('/question/{id}/isQuestionReported', name: 'app_question_isQuestionReported', methods: ['GET'])]
public function isQuestionReported(Request $request, EntityManagerInterface $entityManager, $id): Response
{
    $question = $entityManager->getRepository(Question::class)->find($id);

    if (!$question) {
        throw $this->createNotFoundException('Question not found.');
    }

    $isReported = $question->getSignaleQ() > 0;

    return new Response($isReported ? 'true' : 'false', Response::HTTP_OK);
}

    #[Route('/check_session_status', name:'check_session_status', methods:['GET'])]
    public function checkSessionStatus(SessionInterface $session)
    {
        // Check if the session is active
        $isActive = $session->isStarted();

        // Return a JSON response indicating the session status
        $response = [
            'status' => $isActive ? 'active' : 'inactive',
        ];

        return new JsonResponse($response);
    }

}
