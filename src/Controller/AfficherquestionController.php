<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Utilisateur;
use App\Form\QuestionType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AfficherquestionController extends AbstractController
{
    #[Route('/afficherquestion', name: 'app_afficherquestion')]
    public function showQuestions(ManagerRegistry $entityManager)
{
    $questions = $entityManager->getRepository(Question::class)->findAll();
    //$user = $entityManager->getRepository(Utilisateur::class)->find(question);
    
    return $this->render('afficherquestion/index.html.twig', [
        'questions' => $questions,
    ]);
}

}
