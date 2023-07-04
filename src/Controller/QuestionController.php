<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\QuestionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\QuestionRepository;

class QuestionController extends AbstractController
{
    #[Route('/question', name: 'app_question', methods: ['GET', 'POST'])]
    public function question(Request $request, Security $security, EntityManagerInterface $entityManager): Response
    {
        $date = new \DateTime('@' . strtotime('now'));
        $question = new Question();

        // Retrieve the currently logged-in user
        $user = $security->getUser();

        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Set the idU value for the logged-in user
            $question->setIdU($user);
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

}
