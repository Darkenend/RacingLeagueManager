<?php

namespace App\Controller;

use App\Entity\Race;
use App\Entity\TeamEntryList;
use App\Form\RaceProcessType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("is_granted('ROLE_ADMIN')")
 * @Route("/resultprocessing", name="resultprocessing")
 */
class ResultProcessingController extends AbstractController
{
    /**
     * @Route("/", name="_index")
     */
    public function index(): Response
    {
        return $this->render('result_processing/index.html.twig');
    }

    /**
     * @Route("/races", name="_racelist")
     */
    public function raceList(Request $request): Response
    {
        $form = $this->createForm(RaceProcessType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formdata = $form->getData();
            $json_string = $formdata['resultfile'];
            $raceid = $formdata['raceid'];
            $json_var = json_decode(mb_convert_encoding($json_string, "UTF-8"), true, 512);
            foreach ($json_var as $root_key => $sessionresult_key) {
                if ($root_key == "sessionResult") {
                    foreach ($sessionresult_key as $leaderboardLines_key => $value) {
                        if ($leaderboardLines_key == "leaderBoardLines") {
                            foreach ($value as $item) {
                                $entry = $this->getDoctrine()->getRepository(TeamEntryList::class)->findOneBy([
                                    'race_id'=>$raceid,
                                    'racenumber'=>$item['car']['raceNumber']
                                ]);
                                $entry->setResult($item['timing']['totalTime']);
                                $entry->setBestlap($item['timing']['bestLap']);
                                $entry->setLaps($item['timing']['lapCount']);
                            }
                        }
                    }
                }
            }
            $this->getDoctrine()->getRepository(Race::class)->find($raceid)->setComplete(true);
            $this->getDoctrine()->getManager()->flush();
            return $this->render('result_processing/racelist.html.twig', [
                'message' => 'Race Processed'
            ]);
        }
        return $this->render('result_processing/racelist.html.twig', [
            'form' => $form->createView(),
            'message' => ''
        ]);
    }

    /**
     * @Route("/insert/{id}", name="_insert")
     */
    public function insertAuto(Race $id): Response
    {
        $race = $this->getDoctrine()->getRepository(TeamEntryList::class)->getRaceResult($id);
        $results_directory = scandir($_SERVER['APP_FOLDER']."\\results");
        if (count($results_directory) == 3) {
            $filepath = $_SERVER['APP_FOLDER']."\\results\\".$results_directory[2];
            $backup_path = $_SERVER['APP_FOLDER']."\\backup\\".$results_directory[2];
            copy($filepath, $backup_path);
            $string = iconv('UTF-16LE', 'UTF-8', file_get_contents($filepath));
            $results = json_decode($string, true);
            foreach ($results as $root_key => $sessionresult_key) {
                if ($root_key == "sessionResult") {
                    foreach ($sessionresult_key as $leaderboardLines_key => $value) {
                        if ($leaderboardLines_key == "leaderBoardLines") {
                            foreach ($value as $item) {
                                $entry = $this->getDoctrine()->getRepository(TeamEntryList::class)->findOneBy([
                                    'race_id'=>$id,
                                    'racenumber'=>$item['car']['raceNumber']
                                ]);
                                $entry->setResult($item['timing']['totalTime']);
                                $entry->setBestlap($item['timing']['bestLap']);
                                $entry->setLaps($item['timing']['lapCount']);
                            }
                        }
                    }
                }
            }
            $this->getDoctrine()->getRepository(Race::class)->find($id)->setComplete(true);
            $this->getDoctrine()->getManager()->flush();
        }
        return $this->render("historic/result.html.twig", array('results'=>$race));
    }
}
