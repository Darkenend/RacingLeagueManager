<?php

namespace App\Controller;

use App\Entity\Championship;
use App\Entity\Race;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("is_granted('ROLE_ADMIN')")
 * @Route("/races", name="race")
 */
class RaceController extends AbstractController
{
    /**
     * @Route("/dashboard", name="_dashboard")
     */
    public function index()
    {
        $championships = $this->getDoctrine()->getRepository(Championship::class)->findAll();
        return $this->render('race/index.html.twig', [
            'championships' => $championships,
        ]);
    }
    /**
     * @Route("/champ/{id}", name="_champ")
     */
    public function champInfo($id)
    {
        $races = $this->getDoctrine()->getRepository(Championship::class)->find($id)->getRaces();
        return $this->render("race/race.html.twig", array('races'=>$races));
    }
    /**
     * @Route("/race/{id}", name="_info")
     */
    public function raceInfo($id)
    {
        $race = $this->getDoctrine()->getRepository(Race::class)->find($id);
        return $this->render("race/info.html.twig", array('race'=>$race, 'entrylist'=>$race->getTeamEntryLists()));
    }
}
