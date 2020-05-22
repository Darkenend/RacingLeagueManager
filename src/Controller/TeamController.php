<?php

namespace App\Controller;

use App\Entity\ChampionshipEntries;
use App\Entity\Team;
use App\Entity\TeamDrivers;
use App\Entity\User;
use App\Form\ChampionshipSignupType;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    public function index($id): Response
    {
        $team = $this->getDoctrine()->getRepository(Team::class)->find($id);
        $teamDrivers = $this->getDoctrine()->getRepository(Team::class)->find($id)->getTeamDrivers();
        return $this->render('team/index.html.twig', array('team' => $team, 'teamDrivers' => $teamDrivers));
    }

    /**
     * @Route("/rankup/{driverid}_{teamid}", name="_up")
     */
    public function rankUp(int $driverid, int $teamid): Response
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
    public function rankDown(int $driverid, int $teamid): Response
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
    public function reject(int $driverid, int $teamid): Response
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
    public function invite(int $driverid, int $teamid): Response
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

    /**
     * @Route("/signup/{teamid}", name="_signup")
     */
    public function signUpFor(int $teamid, ?Request $request, LoggerInterface $logger): Response
    {
        $currentUserRank = $this->getDoctrine()->getRepository(TeamDrivers::class)->findOneBy([
            'team' => $teamid,
            'driver' => $this->getUser()
        ])->getRank();
        $team = $this->getDoctrine()->getRepository(Team::class)->find($teamid);
        $teamdrivers = $this->getDoctrine()->getRepository(TeamDrivers::class)->findBy(['team' => $team]);
        $form = null;
        if ($currentUserRank == 2) {
            $result = 1;
            $championshipsignup = new ChampionshipEntries();
            $form = $this->createForm(ChampionshipSignupType::class, $championshipsignup, ['customdata' => $teamid]);
            $form->handleRequest($request);
        }
        else $result = 0;
        if ($form->isSubmitted() && $form->isValid()) {
            $logger->debug('Form Submitted & Valid');
            if (is_null($this->getDoctrine()->getRepository(ChampionshipEntries::class)->findBy(['team'=>$team, 'championship' => $championshipsignup->getChampionship()]))) $result = 3;
            else {
                $entitymanager = $this->getDoctrine()->getManager();
                $championshipsignup->setPoints(0);
                $championshipsignup->setTeam($team);
                $entitymanager->persist($championshipsignup);
                $entitymanager->flush();
                $result = 2;
            }
        }
        switch ($result) {
            case 1:
                return $this->render('team/signup.html.twig', [
                    'form' => $form->createView()
                ]);
            case 2:
                return $this->render('team/index.html.twig', [
                    'team' => $team,
                    'teamDrivers' => $teamdrivers,
                    'message' => 'Registered to '.$championshipsignup->getChampionship()->getName()
                ]);
            case 3:
                return $this->render('team/index.html.twig', [
                    'team' => $team,
                    'teamDrivers' => $teamdrivers,
                    'message' => 'Error: You\'re already signed up to this championship'
                ]);
            default:
                return $this->render('team/index.html.twig', [
                    'team' => $team,
                    'teamDrivers' => $teamdrivers,
                    'message' => 'Error: No Permissions for Registering'
                ]);
        }
    }
}
