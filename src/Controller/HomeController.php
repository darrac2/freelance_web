<?php

namespace App\Controller;

use App\Repository\OffreRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProjectRepository $projectRepository, OffreRepository $offreRepository): Response
    {
        return $this->render('home/index.html.twig', [

            'projects' => $projectRepository->findBy(["publier" => true], ["id" => "DESC"], 3),
            'offre'=> $offreRepository->findBy(["publier" => true], ["id" => "DESC"], 3),
        ]);
    }
}
