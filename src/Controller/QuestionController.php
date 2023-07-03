<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\QuestionType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class QuestionController extends AbstractController
{
    #[Route('/question', name: 'app_question', methods: ['GET', 'POST'])]
    public function question(Request $request, ManagerRegistry $doctrine, Security $security): Response
    {
        $date = new \DateTime('@' . strtotime('now'));
        $question = new Question();

        // Retrieve the currently logged-in user
        $user = $security->getUser();
        $form = $this->createForm(QuestionType::class, $question, [
            'user' => $user,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $question->setDateAjoutQ($date);
            $entityManager->persist($question);
            $entityManager->flush();

            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('question/index.html.twig', [
            'questionForm' => $form->createView(),
        ]);
    }
}
