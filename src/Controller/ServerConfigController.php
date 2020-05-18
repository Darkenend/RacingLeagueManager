<?php

namespace App\Controller;

use App\Form\ConfigurationType;
use App\Form\EventRulesType;
use App\Form\SettingsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("is_granted('ROLE_ADMIN')")
 * @Route("/serverconfig", name="serverconfig")
 */
class ServerConfigController extends AbstractController
{
    /**
     * @Route("/", name="_index")
     */
    public function index()
    {
        return $this->render('server_config/index.html.twig', [
            'message' => ""
        ]);
    }

    /**
     * @Route("/configuration", name="_configuration")
     */
    public function configuration(Request $request): Response
    {
        $form = $this->createForm(ConfigurationType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formdata = $form->getData();
            $filepath = $_SERVER['APP_FOLDER']."\cfg\\configuration.json";
            $configstring = "{\"udpPort\": ".$formdata['port'].",\"tcpPort\": ".$formdata['port'].",\"maxConnections\": ".$formdata['maxConnections'].",\"lanDiscovery\": 0,\"registerToLobby\": 0,\"configVersion\": 1}";
            if (file_exists($filepath)) unlink($filepath);
            file_put_contents($filepath, $configstring);
            return $this->render('server_config/index.html.twig', [
                'message' => "configuration.json has been generated"
            ]);
        }
        return $this->render('server_config/configuration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/settings", name="_settings")
     */
    public function settings(Request $request): Response
    {
        $form = $this->createForm(SettingsType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formdata = $form->getData();
            $filepath = $_SERVER['APP_FOLDER']."\cfg\\settings.json";
            if ($formdata['allowAutoDQ']) $helper1 = 1;
            else $helper1 = 0;
            if ($formdata['shortFormationLap']) $helper2 = 1;
            else $helper2 = 0;
            $configstring = "{\"serverName\": \"".$formdata['serverName']."\",\"adminPassword\": \"".$formdata['adminPassword']."\",\"trackMedalsRequirement\": 3,\"safetyRatingRequirement\": 50, \"racecraftRatingRequirement\": -1,\"maxCarSlots\": ".$formdata['maxCarSlots'].",\"dumpLeaderboards\": 1,\"isRaceLocked\": 0,\"randomizeTrackWhenEmpty\": 0,\"centralEntryListPath\": \"\",\"allowAutoDQ\": ".$helper1.",\"shortFormationLap\": ".$helper2.",\"dumpEntryList\": 0,\"formationLapType\": ".$formdata['formationLapType']."}";
            if (file_exists($filepath)) unlink($filepath);
            file_put_contents($filepath, $configstring);
            return $this->render('server_config/index.html.twig', [
                'message' => "settings.json has been generated"
            ]);
        }
        return $this->render('server_config/settings.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/eventrules", name="_eventrules")
     */
    public function eventRules(Request $request): Response
    {
        $form = $this->createForm(EventRulesType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formdata = $form->getData();
            $filepath = $_SERVER['APP_FOLDER']."\cfg\\eventRules.json";
            if ($formdata['isRefuellingTimeFixed']) $helper = "true";
            else $helper = "false";
            $configstring = "{\"qualifyStandingType\": ".$formdata['qualifyStandingType'].", \"isRefuellingTimeFixed\": ".$helper."}";
            if (file_exists($filepath)) unlink($filepath);
            file_put_contents($filepath, $configstring);
            return $this->render('server_config/index.html.twig', [
                'message' => "entryList.json has been generated"
            ]);
        }
        return $this->render('server_config/entryrules.html.twig', [
            'form' => $form->createView()
        ]);
    }
}