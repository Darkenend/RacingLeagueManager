<?php

namespace App\Controller;

use App\Entity\Championship;
use App\Entity\Race;
use App\Entity\TeamEntryList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;
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
    public function index(): Response
    {
        $championships = $this->getDoctrine()->getRepository(Championship::class)->findAll();
        return $this->render('race/index.html.twig', [
            'championships' => $championships,
        ]);
    }
    /**
     * @Route("/champ/{id}", name="_champ")
     */
    public function champInfo($id): Response
    {
        $races = $this->getDoctrine()->getRepository(Championship::class)->find($id)->getRaces();
        return $this->render("race/race.html.twig", array('races'=>$races));
    }
    /**
     * @Route("/race/{id}", name="_info")
     */
    public function raceInfo($id): Response
    {
        $race = $this->getDoctrine()->getRepository(Race::class)->find($id);
        return $this->render("race/info.html.twig", array('race'=>$race, 'entrylist'=>$race->getTeamEntryLists()));
    }

    /**
     * @Route("/entrylist/{id}", name="_entrylist")
     */
    public function createEntryList($id): Response
    {
        $race = $this->getDoctrine()->getRepository(Race::class)->find($id);
        $entrylist = $race->getTeamEntryLists();
        $this->generateEntrylist($entrylist);
        return $this->render("race/info.html.twig", array('race'=>$race, 'entrylist'=>$entrylist));
    }

    /**
     * @Route("/launch/{id}", name="_launch")
     */
    public function launchServer($id): Response
    {
        $race = $this->getDoctrine()->getRepository(Race::class)->find($id);
        $message = 'The race server for '.$race->getChampionshipId()->getName().' at '.ucwords(str_replace('_', ' ', str_replace('_2019', '', $race->getTrack()))).' has been launched.';
        $entrylist = $race->getTeamEntryLists();
        $this->generateEntrylist($entrylist);
        $process = new Process([$_SERVER['APP_FOLDER'].'\\accServer.exe', $_SERVER['APP_FOLDER']]);
        $process->setTimeout($this->calculateTimeout($race));
        //if ($_ENV['APP_ENV'] == 'dev') $process->start();
        return $this->render('admin/server.html.twig', [
            'message' => $message,
            'race' => $race
        ]);
    }

    /**
     * This function generates an entrylist.json based on the entrylists given.
     * @param TeamEntryList[] $entrylist Array with Entrylists
     */
    private function generateEntrylist($entrylist): void
    {
        $entrylist_json = '{"entries":[';
        foreach ($entrylist as $entry) {
            $teamdrivers = $entry->getTeamId()->getTeamDrivers();
            $entrylist_json = $entrylist_json.'{"drivers":[';
            $drivercount = 0;
            foreach ($teamdrivers as $driver) {
                $entrylist_json = $drivercount == 0 ? $entrylist_json.
                    '{"firstName":"' . $driver->getDriver()->getName() . '", "lastName": "' .$driver->getDriver()->getLastname() . '", "playerID": "S' . $driver->getDriver()->getSteamid() . '"}' : $entrylist_json . ',{"firstName":"' . $driver->getDriver()->getName() . '", "lastName": "' . $driver->getDriver()->getLastname() . '", "playerID": "S' . $driver->getDriver()->getSteamid() . '"}';
                $drivercount++;
            }
            $entrylist_json = $entrylist_json.'],"raceNumber":'.$entry->getRacenumber().',';
            $entrylist_json = $entrylist_json.'"forcedCarModel":'.$entry->getCarmodel();
            if (!next($entrylist)) {
                $entrylist_json = $entrylist_json . '}';
            } else {
                $entrylist_json = $entrylist_json . '},';
            }
        }
        $entrylist_json = $entrylist_json.'], "forceEntryList": 1}';
        $filepath = $_SERVER['APP_FOLDER']."\cfg\\entrylist.json";
        file_put_contents($filepath, $entrylist_json);
    }

    private function calculateTimeout(Race $race): int
    {
        $result = 0;
        $result += $race->getPracticeLength()*60;
        $result += $race->getQualyLength()*60;
        $result += $race->getRaceLength()*60;
        return $result;
    }
}
