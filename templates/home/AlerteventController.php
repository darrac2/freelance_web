<?php

namespace App\Controller;

use App\Entity\Alertevent;
use App\Form\AlerteventType;
use App\Repository\AlerteventRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/alertevent')]
class AlerteventController extends AbstractController
{
    #[Route('/', name: 'app_alertevent_index', methods: ['GET'])]
    public function index(AlerteventRepository $alerteventRepository): Response
    {
        return $this->render('alertevent/index.html.twig', [
            'alertevents' => $alerteventRepository->findAll(),
        ]);
    }

    #[Route('/admin', name: 'app_alertevent_admin', methods: ['GET'])]
    public function admin(AlerteventRepository $alerteventRepository): Response
    {
        return $this->render('alertevent/admin.html.twig', [
            'alertevents' => $alerteventRepository->findAll(),
        ]);
    }
    #[Route('/publier/{id}', name: 'app_alertevent_publier', methods: ['GET'])]
    public function publier( Alertevent $alertevent, EntityManagerInterface $entityManager): Response
    {
        if($alertevent->isPublier() == 1){
            $alertevent->setPublier(0);
        }else{
            $alertevent->setPublier(1);
        }
        $entityManager->persist($alertevent);
        $entityManager->flush();
        return $this->redirectToRoute('app_alertevent_admin', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/new', name: 'app_alertevent_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $alertevent = new Alertevent();
        $form = $this->createForm(AlerteventType::class, $alertevent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //set date
            $alertevent->setDate(new \DateTime());
            $alertevent->setSend(0);
            $entityManager->persist($alertevent);
            $entityManager->flush();

            return $this->redirectToRoute('app_alertevent_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('alertevent/new.html.twig', [
            'alertevent' => $alertevent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_alertevent_show', methods: ['GET'])]
    public function show(Alertevent $alertevent): Response
    {
        return $this->render('alertevent/show.html.twig', [
            'alertevent' => $alertevent,
        ]);
    }
    #[Route('/admin/{id}', name: 'app_alertevent_showadmin', methods: ['GET'])]
    public function showadmin(Alertevent $alertevent): Response
    {
        return $this->render('alertevent/showadmin.html.twig', [
            'alertevent' => $alertevent,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_alertevent_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Alertevent $alertevent, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AlerteventType::class, $alertevent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_alertevent_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('alertevent/edit.html.twig', [
            'alertevent' => $alertevent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_alertevent_delete', methods: ['POST'])]
    public function delete(Request $request, Alertevent $alertevent, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$alertevent->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($alertevent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_alertevent_admin', [], Response::HTTP_SEE_OTHER);
    }
}
