<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("is_granted('ROLE_USER')")
 * @Route("/team", name="team")
 */
class TeamController extends AbstractController
{
    /**
     * @Route("/{id}", name="_profile")
     */
    public function index($id)
    {
        $valid = false;
        $userTeams = $this->getDoctrine()->getRepository(User::class)->find($this->getUser()->getId())->getTeamDrivers();
        foreach ($userTeams as $userTeam) if ($userTeam->getId() == $id) $valid = true;
        if ($valid) {
            $team = $this->getDoctrine()->getRepository(Team::class)->find($id);
            $teamDrivers = $this->getDoctrine()->getRepository(Team::class)->find($id)->getTeamDrivers();
            return $this->render('team/index.html.twig', array('team' => $team, 'teamDrivers' => $teamDrivers));
        } else return $this->render('user/teams.html.twig', array('teams'=>$userTeams));
    }

    /**
     * @Route("/rankup/{driverid}_{teamid}", name="_up")
     */
    public function rankUp($driverid, $teamid)
    {
        $teamDrivers = $this->getDoctrine()->getRepository(Team::class)->find($teamid)->getTeamDrivers();
        foreach ($teamDrivers as $driver) {
            if ($driver->getId() == $driverid && $driver->getRank() != 2) {
                $driver->setRank($driver->getRank()+1);
                $em = $this->getDoctrine()->getManager();
                $em->flush();
            }
        }
        $team = $this->getDoctrine()->getRepository(Team::class)->find($teamid);
        return $this->render('team/index.html.twig', array('team' => $team, 'teamDrivers' => $teamDrivers));
    }

    /**
     * @Route("/rankdown/{driverid}_{teamid}", name="_down")
     */
    public function rankDown($driverid, $teamid)
    {
        $teamDrivers = $this->getDoctrine()->getRepository(Team::class)->find($teamid)->getTeamDrivers();
        foreach ($teamDrivers as $driver) {
            if ($driver->getId() == $driverid && $driver->getRank() != 0) {
                $driver->setRank($driver->getRank()-1);
                $em = $this->getDoctrine()->getManager();
                $em->flush();
            }
        }
        $team = $this->getDoctrine()->getRepository(Team::class)->find($teamid);
        return $this->render('team/index.html.twig', array('team' => $team, 'teamDrivers' => $teamDrivers));
    }

    /**
     * @Route("/reject/{driverid}_{teamid}", name="_reject")
     */
    public function reject($driverid, $teamid)
    {
        $teamDrivers = $this->getDoctrine()->getRepository(Team::class)->find($teamid)->getTeamDrivers();
        foreach ($teamDrivers as $driver) {
            if ($driver->getId() == $driverid) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($driver);
                $em->flush();
            }
        }
        $team = $this->getDoctrine()->getRepository(Team::class)->find($teamid);
        return $this->render('team/index.html.twig', array('team' => $team, 'teamDrivers' => $teamDrivers));
    }
}
