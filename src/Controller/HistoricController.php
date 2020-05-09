<?php

namespace App\Controller;

use App\Entity\Championship;
use App\Entity\TeamEntryList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/historic", name="historic")
 */
class HistoricController extends AbstractController
{
    /**
     * @Route("/", name="_championships")
     */
    public function index()
    {
        $championships = $this->getDoctrine()->getRepository(Championship::class)->findAll();
        return $this->render("historic/index.html.twig", array('championships'=>$championships));
    }

    /**
     * @Route("/{id}", name="_races")
     */
    public function races($id)
    {
        $races = $this->getDoctrine()->getRepository(Championship::class)->find($id)->getRaces();
        return $this->render("historic/race.html.twig", array('races'=>$races));
    }

    /**
     * @Route("/race/{id}", name="_race")
     */
    public function race($id)
    {
        $race = $this->getDoctrine()->getRepository(TeamEntryList::class)->getRaceResult($id);
        return $this->render("historic/result.html.twig", array('results'=>$race));
    }
}
