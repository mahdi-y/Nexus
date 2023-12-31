<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\QuestionRepository;
use App\Repository\UtilisateurRepository;
use App\Repository\VoteRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class HomepageController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/homepage', name: 'homepage')]
    public function homepage(): Response
    {
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
    #[Route('/searchroute', name: 'search_route')]
    public function searchroute(Request $request, QuestionRepository $repo, UtilisateurRepository $repouti, VoteRepository $voterepo): Response
    {
        $out = new ConsoleOutput();
        $user = $this->security->getUser();
        if ($user instanceof Utilisateur) {
            $idU = $user->getIdU();
        }
        if ($request->isMethod('POST')) {
            $searchQuery = $request->request->get('search_query');

            // Call your Java application passing $searchQuery as the input
            // Escape the search query argument with escapeshellarg()
            $escapedSearchQuery = escapeshellarg($searchQuery);

            // Command to execute
            $command = 'echo ' . $escapedSearchQuery . ' | java -jar "D:/Esprit/3eme/vermeg stage project/web application/Nexus/NLP/dist/dist/test.jar"';

            // Execute the command and store the output in the $output variable
            $output = [];
            exec($command, $output);

            // $output now contains the output of the Java application
            // You can access and use it as needed
            $jsonString = implode('', $output); // Convert array to a single string
            $output = json_decode($jsonString, true); // Decode the JSON string into an array
            $votes = [];
            $voteDB = $voterepo->findAll();
            foreach ($output as $item) {
                $question = $item['question'];
                $votes[$question] = $repo->getVotesForQuestion($question);
            }
            // Populate $questionData array from the database
            $questionData = [];
            foreach ($output as $item) {
                $question = $item['question'];
                $questionEntities = $repo->findBy(['contenuQ' => $question]);
                if (!empty($questionEntities)) {
                    $questionEntity = $questionEntities[0]; // Access the first element of the array
                    $questionuserid = $repo->getUIDbyname($questionEntity->getContenuQ());
                    $questionData[$question] = [
                        'Date_Ajout_Q' => $this->calculateDaysAgo($questionEntity->getdateAjoutQ()),
                        'id_U' => $questionuserid->getIdU(),
                        'nom_U' => $questionuserid->getPrenomU(),
                        'id_Q' => $questionEntity->getIdQ()
                    ];
                }
            }
        }

        // Render the template with the form
        return $this->render(
            'homepage/search1.html.twig',
            [
                'jsonOutput' => $output,
                'votes' => $votes,
                'questionData' => $questionData,
                'voteDB' => $voteDB,
                'id_U' => $idU
            ]
        );
    }
    private function calculateDaysAgo(DateTime $dateAjoutQ): string
    {
        $currentDate = new DateTime();
        $interval = $currentDate->diff($dateAjoutQ);
        return $interval->format('%a');
    }
}
