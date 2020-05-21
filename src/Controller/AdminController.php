<?php

namespace App\Controller;

use App\Entity\Championship;
use App\Entity\Race;
use App\Form\CreateChampionshipType;
use App\Form\RaceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("is_granted('ROLE_ADMIN')")
 * @Route("/admin", name="admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="_home")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/championshipcreation", name="_championship")
     */
    public function createChampionship(Request $request): Response
    {
        $championship = new Championship();
        $form = $this->createForm(CreateChampionshipType::class, $championship);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($championship);
            $entityManager->flush();
            return $this->redirectToRoute('admin_home');
        }
        return $this->render('admin/championship.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/racecreation", name="_race")
     */
    public function createRace(Request $request): Response
    {
        $race = new Race();
        $form = $this->createForm(RaceType::class, $race);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $race->setComplete(false);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($race);
            $entityManager->flush();
        }
        return $this->render('admin/race.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
