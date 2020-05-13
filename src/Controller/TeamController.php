<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\TeamDrivers;
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
        $team = $this->getDoctrine()->getRepository(Team::class)->find($id);
        $teamDrivers = $this->getDoctrine()->getRepository(Team::class)->find($id)->getTeamDrivers();
        return $this->render('team/index.html.twig', array('team' => $team, 'teamDrivers' => $teamDrivers));
    }

    /**
     * @Route("/rankup/{driverid}_{teamid}", name="_up")
     */
    public function rankUp(int $driverid, int $teamid)
    {
        $teamDrivers = $this->getDoctrine()->getRepository(TeamDrivers::class)->findBy(['team'=>$teamid]);
        $teamDriverEntry = $this->getDoctrine()->getRepository(TeamDrivers::class)->findOneBy([
            'driver' => $driverid,
            'team' => $teamid
        ]);
        if ($teamDriverEntry->getDriver()->getId() == $driverid && $teamDriverEntry->getRank() != 2) {
            $teamDriverEntry->increaseRank();
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }
        $team = $this->getDoctrine()->getRepository(Team::class)->find($teamid);
        return $this->render('team/index.html.twig', array('team' => $team, 'teamDrivers' => $teamDrivers));
    }

    /**
     * @Route("/rankdown/{driverid}_{teamid}", name="_down")
     */
    public function rankDown(int $driverid, int $teamid)
    {
        $teamDrivers = $this->getDoctrine()->getRepository(TeamDrivers::class)->findBy(['team'=>$teamid]);
        $teamDriverEntry = $this->getDoctrine()->getRepository(TeamDrivers::class)->findOneBy([
            'driver' => $driverid,
            'team' => $teamid
        ]);
        if ($teamDriverEntry->getDriver()->getId() == $driverid && $teamDriverEntry->getRank() != 2) {
            $teamDriverEntry->decreaseRank();
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }
        $team = $this->getDoctrine()->getRepository(Team::class)->find($teamid);
        return $this->render('team/index.html.twig', array('team' => $team, 'teamDrivers' => $teamDrivers));
    }

    /**
     * @Route("/reject/{driverid}_{teamid}", name="_reject")
     */
    public function reject(int $driverid, int $teamid)
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

    /**
     * @Route("/apply/{driverid}_{teamid}", name="_invite")
     */
    public function invite(int $driverid, int $teamid)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $teamDriver = new TeamDrivers();
        $teamDriver->setRank(0);
        $teamDriver->setDriver($entityManager->getRepository(User::class)->find($driverid));
        $teamDriver->setTeam($entityManager->getRepository(Team::class)->find($teamid));
        $entityManager->persist($teamDriver);
        $entityManager->flush();
        return $this->render('user/teams.html.twig');
    }
}
