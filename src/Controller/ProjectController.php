<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("/project", name="project")
     */
    public function index(): Response
    {
        return $this->render('project/index.html.twig', [
            'controller_name' => 'ProjectController',
        ]);
    }
    /**
     * @Route("/project/add", name="add_project")
     */
    public function createProject(Request $request): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {


            $project->setCreatedAt(new \DateTime('now', new \DateTimeZone('Europe/Paris')));;
            $project->setStatus(0);

            $project->setTitle(
                $form->get('title')->getData()
            );
            $project->setDescription(
                $form->get('description')->getData()
            );
            $project->setStartAt(
                $form->get('start_at')->getData()
            );
            $project->setEndAt(
                $form->get('end_at')->getData()
            );
            $project->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();


            return $this->redirectToRoute('add_project');
        }


        return $this->render('project/add.html.twig', [
            'controller_name' => 'ProjectController',
            'Project' => $form->createView(),
        ]);
    }

    /**
     * @Route("/project/delete", name="del_project")
     */
    public function deleteProject(): Response
    {
        return $this->render('project/del.html.twig', [
            'controller_name' => 'ProjectController',
        ]);
    }
}
