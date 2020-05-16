<?php

namespace App\Controller;

use App\Entity\Championship;
use App\Entity\Race;
use Psr\Log\LoggerInterface;
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

    /**
     * @Route("/entrylist/{id}", name="_entrylist")
     */
    public function generateEntryList($id, LoggerInterface $logger)
    {
        $race = $this->getDoctrine()->getRepository(Race::class)->find($id);
        $entrylist = $race->getTeamEntryLists();
        $entrylist_json = '{"entries":[';
        foreach ($entrylist as $entry) {
            $teamdrivers = $entry->getTeamId()->getTeamDrivers();
            $entrylist_json = $entrylist_json.'{"drivers":[';
            $drivercount = 0;
            foreach ($teamdrivers as $driver) {
                $entrylist_json = $drivercount == 0 ? $entrylist_json . '{"firstName":"' . $driver->getDriver()->getName() . '", "lastName": "' . $driver->getDriver()->getLastname() . '", "playerID": "S' . $driver->getDriver()->getSteamid() . '"}' : $entrylist_json . ',{"firstName":"' . $driver->getDriver()->getName() . '", "lastName": "' . $driver->getDriver()->getLastname() . '", "playerID": "S' . $driver->getDriver()->getSteamid() . '"}';
                $drivercount++;
            }
            $entrylist_json = $entrylist_json.'],"raceNumber":'.$entry->getRacenumber().',';
            $entrylist_json = $entrylist_json.'"forcedCarModel":'.$entry->getCarmodel();
            $entrylist_json = !next($entrylist) ? $entrylist_json . '}' : $entrylist_json . '},';
        }
        $entrylist_json = $entrylist_json.'], "forceEntryList": 0}';
        /*
        $filepath = getenv('SERVER_FOLDER')."/cfg/entrylist.json";
        $logger->debug("Server Folder Path:", [
            'cause' => $filepath
        ]);
        file_put_contents(getenv('SERVER_FOLDER')."/cfg/entrylist.json", $entrylist_json);
        */
        return $this->render("race/info.html.twig", array('race'=>$race, 'entrylist'=>$entrylist));
    }
}
