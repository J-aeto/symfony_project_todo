<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrelloController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();

        return $this->render('trello/index.html.twig', [
            'controller_name' => 'TrelloController',
            'projects' =>  $projects
        ]);
    }
}
