<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("is_granted('ROLE_USER')")
 * @Route("/user", name="user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="_home")
     */
    public function index()
    {
        return $this->render('user/index.html.twig');
    }

    /**
     * @Route("/teams", name="_teams")
     */
    public function seeTeams()
    {
        $allteams = $this->getDoctrine()->getRepository(Team::class)->findAll();
        $teams = $this->getDoctrine()->getRepository(User::class)->find($this->getUser()->getId())->getTeamDrivers();
        return $this->render('user/teams.html.twig', array('teams'=>$teams, 'allteams'=>$allteams));
    }
}
