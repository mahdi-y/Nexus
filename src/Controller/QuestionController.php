<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\QuestionType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class QuestionController extends AbstractController
{
    #[Route('/question', name: 'app_question', methods: ['GET', 'POST'])]
    public function question(Request $request,ManagerRegistry $doctrine): Response
    {
        $date = new \DateTime('@' . strtotime('now'));
        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);
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
