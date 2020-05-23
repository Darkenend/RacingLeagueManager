<?php

namespace App\Controller;

use App\Form\AssistsType;
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
            $configstring = "{\"udpPort\": ".$formdata['port'].",\"tcpPort\": ".$formdata['port'].",\"maxConnections\": ".$formdata['maxConnections'].",\"lanDiscovery\": 1,\"registerToLobby\": 0,\"configVersion\": 1}";
            $this->dumpJSON($_SERVER['APP_FOLDER']."\cfg\\configuration.json", $configstring);
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
            if ($formdata['allowAutoDQ']) $helper1 = 1;
            else $helper1 = 0;
            if ($formdata['shortFormationLap']) $helper2 = 1;
            else $helper2 = 0;
            $configstring = "{\"serverName\": \"".$formdata['serverName']."\",\"adminPassword\": \"".$formdata['adminPassword'].", \"racecraftRatingRequirement\": -1,\"maxCarSlots\": ".$formdata['maxCarSlots'].",\"dumpLeaderboards\": 1,\"isRaceLocked\": 0,\"randomizeTrackWhenEmpty\": 0,\"centralEntryListPath\": \"\",\"allowAutoDQ\": ".$helper1.",\"shortFormationLap\": ".$helper2.",\"dumpEntryList\": 0,\"formationLapType\": ".$formdata['formationLapType']."}";
            $this->dumpJSON($_SERVER['APP_FOLDER']."\cfg\\settings.json", $configstring);
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
            if ($formdata['isRefuellingTimeFixed']) $helper = "true";
            else $helper = "false";
            $configstring = "{\"qualifyStandingType\": ".$formdata['qualifyStandingType'].", \"isRefuellingTimeFixed\": ".$helper."}";
            $this->dumpJSON($_SERVER['APP_FOLDER']."\cfg\\eventRules.json", $configstring);
            return $this->render('server_config/index.html.twig', [
                'message' => "entryList.json has been generated"
            ]);
        }
        return $this->render('server_config/entryrules.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/assistrules", name="_assists")
     */
    public function assistRules(Request $request): Response {
        $form = $this->createForm(AssistsType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formdata = $form->getData();
            $configstring = "{\"stabilityControlLevelMax\": ".$formdata['stabilityControlLevelMax'].",\"disableAutosteer\": ".$formdata['disableAutosteer'].",\"disableAutoLights\": ".$formdata['disableAutoLights'].",\"disableAutoWiper\": ".$formdata['disableAutoWiper'].",\"disableAutoEngineStart\": ".$formdata['disableAutoEngineStart'].",\"disableAutoPitLimiter\": ".$formdata['disableAutoPitLimiter'].",\"disableAutoGear\": ".$formdata['disableAutoGear'].",\"disableAutoClutch\": ".$formdata['disableAutoClutch'].",\"disableIdealLine\": ".$formdata['disableIdealLine']."}";
            $this->dumpJSON($_SERVER['APP_FOLDER']."\cfg\\assistRules.json", $configstring);
            return $this->render('server_config/index.html.twig', [
                'message' => "assistRules.json has been generated"
            ]);
        }
        return $this->render('server_config/assistrules.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * This function checks if a file exists, to delete it, and create a new one according to what we're sending it.
     * @param string $filepath Path and name of the file to create
     * @param string $json JSON to print to the file
     */
    private function dumpJSON(string $filepath, string $json): void {
        if (file_exists($filepath)) unlink($filepath);
        file_put_contents($filepath, json_encode(json_decode($json), JSON_PRETTY_PRINT));
    }
}