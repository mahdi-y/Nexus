<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReponseController extends AbstractController
{
    #[Route('/', name: 'app_reponse')]
    public function index(): Response
    {
        return $this->render('front.html.twig', [
            'controller_name' => 'ReponseController',
        ]);
    }
}
