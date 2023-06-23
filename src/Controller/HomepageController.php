<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(): Response
    {
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
    #[Route('/searchroute', name: 'search_route')]
    public function searchroute(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $searchQuery = $request->request->get('search_query');

            // Call your Java application passing $searchQuery as the input
            // Escape the search query argument with escapeshellarg()
            $escapedSearchQuery = escapeshellarg($searchQuery);

            // Command to execute
            $command = 'echo ' . $escapedSearchQuery . ' | java -jar "D:/Esprit/3eme/vermeg stage project/test/dist/test.jar"';

            // Execute the command and store the output in the $output variable
            $output = [];
            exec($command, $output);

            // $output now contains the output of the Java application
            // You can access and use it as needed
            $jsonString = implode('', $output); // Convert array to a single string
            $output = json_decode($jsonString, true); // Decode the JSON string into an array
        }

        // Render the template with the form
        return $this->render(
            'homepage/search1.html.twig',
            [
                'jsonOutput' => $output,
            ]
        );
    }
}
