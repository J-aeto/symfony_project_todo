<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class TrelloController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProjectRepository $projectRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $projects = $projectRepository->findAll();

        $project = $paginator->paginate(
            $projects,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('trello/index.html.twig', [
            'controller_name' => 'TrelloController',
            'projects' => $project,
        ]);
    }
}
