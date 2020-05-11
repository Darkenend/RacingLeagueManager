<?php

namespace App\DataFixtures;

use App\Entity\Championship;
use App\Entity\ChampionshipEntries;
use App\Entity\Race;
use App\Entity\Team;
use App\Entity\TeamDrivers;
use App\Entity\TeamEntryList;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /** @noinspection PhpHierarchyChecksInspection
     * @noinspection PhpSignatureMismatchDuringInheritanceInspection
     */
    public function load(ObjectManager $manager)
    {
        $mailsuffix = "@gmail.com";
        // Equipos
        $team_1 = new Team();
        $team_1->setName("Family Sim Racing");
        $team_1->setPrivacy(0);
        $team_2 = new Team();
        $team_2->setName("Ingobernables");
        $team_2->setPrivacy(1);
        $team_3 = new Team();
        $team_3->setName("Doug Henderson Racing");
        $team_3->setPrivacy(2);

        // Usuarios
        $user_1 = new User();
        $user_2 = new User();
        $user_3 = new User();
        $user_4 = new User();
        $user_5 = new User();
        $user_6 = new User();
        $user_1->setRoles(['ROLE_ADMIN']);
        $user_1->setName("Álvaro");
        $user_1->setLastname("Real");
        $user_1->setSteamid("76561191111111111");
        $user_1->setEmail($this->mailFormer($user_1).$mailsuffix);
        $user_1->setPassword($this->passwordEncoder->encodePassword($user_1, 'password'));
        $teamdriver_1 = new TeamDrivers();
        $teamdriver_1->setDriver($user_1);
        $teamdriver_1->setTeam($team_1);
        $teamdriver_1->setRank(1);
        $teamdriver_2 = new TeamDrivers();
        $teamdriver_2->setDriver($user_1);
        $teamdriver_2->setTeam($team_2);
        $teamdriver_2->setRank(2);
        $user_2->setName("Javier");
        $user_2->setLastname("Ramirez");
        $user_2->setSteamid("76561191211111111");
        $user_2->setEmail($this->mailFormer($user_2).$mailsuffix);
        $user_2->setPassword($this->passwordEncoder->encodePassword($user_2, 'password'));
        $teamdriver_3 = new TeamDrivers();
        $teamdriver_3->setDriver($user_2);
        $teamdriver_3->setTeam($team_1);
        $teamdriver_3->setRank(2);
        $user_3->setName("Carlos");
        $user_3->setLastname("Vidal");
        $user_3->setSteamid("76561191311111111");
        $user_3->setEmail($this->mailFormer($user_3).$mailsuffix);
        $user_3->setPassword($this->passwordEncoder->encodePassword($user_3, 'password'));
        $teamdriver_4 = new TeamDrivers();
        $teamdriver_4->setDriver($user_3);
        $teamdriver_4->setTeam($team_1);
        $teamdriver_4->setRank(0);
        $user_4->setName("Dano");
        $user_4->setLastname("Cumbiote");
        $user_4->setSteamid("76561191411111111");
        $user_4->setEmail($this->mailFormer($user_4).$mailsuffix);
        $user_4->setPassword($this->passwordEncoder->encodePassword($user_4, 'password'));
        $teamdriver_5 = new TeamDrivers();
        $teamdriver_5->setDriver($user_4);
        $teamdriver_5->setTeam($team_2);
        $teamdriver_5->setRank(1);
        $user_5->setName("Jimmy");
        $user_5->setLastname("Broadbent");
        $user_5->setSteamid("76561191511111111");
        $user_5->setEmail($this->mailFormer($user_5).$mailsuffix);
        $user_5->setPassword($this->passwordEncoder->encodePassword($user_5, 'password'));
        $teamdriver_6 = new TeamDrivers();
        $teamdriver_6->setDriver($user_5);
        $teamdriver_6->setTeam($team_3);
        $teamdriver_6->setRank(1);
        $user_6->setName("Stephen");
        $user_6->setLastname("Bailey");
        $user_6->setSteamid("76561191611111111");
        $user_6->setEmail($this->mailFormer($user_6).$mailsuffix);
        $user_6->setPassword($this->passwordEncoder->encodePassword($user_6, 'password'));
        $teamdriver_7 = new TeamDrivers();
        $teamdriver_7->setDriver($user_6);
        $teamdriver_7->setTeam($team_3);
        $teamdriver_7->setRank(2);

        // Carreras
        $race_1 = new Race();
        $race_2 = new Race();
        $race_3 = new Race();
        $race_4 = new Race();
        $race_1->setTrack("monza_2019");
        $race_1->setAmbientTemp(24);
        $race_1->setCloudLevel(0.3);
        $race_1->setRain(0.1);
        $race_1->setPracticeHour(10);
        $race_1->setPracticeLength(5);
        $race_1->setQualyHour(14);
        $race_1->setQualyLength(30);
        $race_1->setRaceHour(14);
        $race_1->setRaceLength(180);
        $race_2->setTrack("suzuka_2019");
        $race_2->setAmbientTemp(24);
        $race_2->setCloudLevel(0.6);
        $race_2->setRain(0.3);
        $race_2->setPracticeHour(10);
        $race_2->setPracticeLength(5);
        $race_2->setQualyHour(14);
        $race_2->setQualyLength(30);
        $race_2->setRaceHour(14);
        $race_2->setRaceLength(60*9);
        $race_3->setTrack("laguna_seca_2019");
        $race_3->setAmbientTemp(21);
        $race_3->setCloudLevel(0.3);
        $race_3->setRain(0);
        $race_3->setPracticeHour(10);
        $race_3->setPracticeLength(5);
        $race_3->setQualyHour(14);
        $race_3->setQualyLength(30);
        $race_3->setRaceHour(14);
        $race_3->setRaceLength(240);
        $race_4->setTrack("nurburgring_2019");
        $race_4->setAmbientTemp(20);
        $race_4->setCloudLevel(0.3);
        $race_4->setRain(0.1);
        $race_4->setPracticeHour(10);
        $race_4->setPracticeLength(5);
        $race_4->setQualyHour(14);
        $race_4->setQualyLength(30);
        $race_4->setRaceHour(14);
        $race_4->setRaceLength(360);

        // Entrylists
            // Race 1
        $entrylist_1_1 = new TeamEntryList();
        $entrylist_1_1->setTeamId($team_1);
        $entrylist_1_1->setRacenumber(866);
        $entrylist_1_1->setRaceId($race_1);
        $entrylist_1_1->setResult(719894);
        $entrylist_1_1->setBestlap(118404);
        $entrylist_1_1->setCarmodel(19);
        $entrylist_1_2 = new TeamEntryList();
        $entrylist_1_2->setTeamId($team_2);
        $entrylist_1_2->setRacenumber(273);
        $entrylist_1_2->setRaceId($race_1);
        $entrylist_1_2->setResult(719894);
        $entrylist_1_2->setBestlap(118404);
        $entrylist_1_2->setCarmodel(23);
        $entrylist_1_3 = new TeamEntryList();
        $entrylist_1_3->setTeamId($team_3);
        $entrylist_1_3->setRacenumber(1);
        $entrylist_1_3->setRaceId($race_1);
        $entrylist_1_3->setResult(719894);
        $entrylist_1_3->setBestlap(118404);
        $entrylist_1_3->setCarmodel(6);
            // Race 2
        $entrylist_2_1 = new TeamEntryList();
        $entrylist_2_1->setTeamId($team_1);
        $entrylist_2_1->setRacenumber(866);
        $entrylist_2_1->setRaceId($race_2);
        $entrylist_2_1->setResult(719894);
        $entrylist_2_1->setBestlap(118404);
        $entrylist_2_1->setCarmodel(19);
        $entrylist_2_2 = new TeamEntryList();
        $entrylist_2_2->setTeamId($team_2);
        $entrylist_2_2->setRacenumber(273);
        $entrylist_2_2->setRaceId($race_2);
        $entrylist_2_2->setResult(719894);
        $entrylist_2_2->setBestlap(118404);
        $entrylist_2_2->setCarmodel(23);
        $entrylist_2_3 = new TeamEntryList();
        $entrylist_2_3->setTeamId($team_3);
        $entrylist_2_3->setRacenumber(1);
        $entrylist_2_3->setRaceId($race_2);
        $entrylist_2_3->setResult(719894);
        $entrylist_2_3->setBestlap(118404);
        $entrylist_2_3->setCarmodel(6);
            // Race 3
        $entrylist_3_1 = new TeamEntryList();
        $entrylist_3_1->setTeamId($team_1);
        $entrylist_3_1->setRacenumber(866);
        $entrylist_3_1->setRaceId($race_3);
        $entrylist_3_1->setResult(719894);
        $entrylist_3_1->setBestlap(118404);
        $entrylist_3_1->setCarmodel(19);
        $entrylist_3_2 = new TeamEntryList();
        $entrylist_3_2->setTeamId($team_2);
        $entrylist_3_2->setRacenumber(273);
        $entrylist_3_2->setRaceId($race_3);
        $entrylist_3_2->setResult(719894);
        $entrylist_3_2->setBestlap(118404);
        $entrylist_3_2->setCarmodel(23);
        $entrylist_3_3 = new TeamEntryList();
        $entrylist_3_3->setTeamId($team_3);
        $entrylist_3_3->setRacenumber(1);
        $entrylist_3_3->setRaceId($race_3);
        $entrylist_3_3->setResult(719894);
        $entrylist_3_3->setBestlap(118404);
        $entrylist_3_3->setCarmodel(6);

        // Campeonatos
        $championship = new Championship();
        $championship->setName("Campeonato de Pruebas");
        $championship->addRace($race_1);
        $championship->addRace($race_2);
        $championship->addRace($race_3);
        $championship->addRace($race_4);
        $championshipEntry_1 = new ChampionshipEntries();
        $championshipEntry_2 = new ChampionshipEntries();
        $championshipEntry_3 = new ChampionshipEntries();
        $championshipEntry_1->setTeam($team_1);
        $championshipEntry_2->setTeam($team_2);
        $championshipEntry_3->setTeam($team_3);
        $championshipEntry_1->setChampionship($championship);
        $championshipEntry_2->setChampionship($championship);
        $championshipEntry_3->setChampionship($championship);
        $championshipEntry_1->setPoints(0);
        $championshipEntry_2->setPoints(0);
        $championshipEntry_3->setPoints(0);

        // Manager
        $manager->persist($team_1);
        $manager->persist($team_2);
        $manager->persist($team_3);
        $manager->persist($user_1);
        $manager->persist($user_2);
        $manager->persist($user_3);
        $manager->persist($user_4);
        $manager->persist($user_5);
        $manager->persist($user_6);
        $manager->persist($teamdriver_1);
        $manager->persist($teamdriver_2);
        $manager->persist($teamdriver_3);
        $manager->persist($teamdriver_4);
        $manager->persist($teamdriver_5);
        $manager->persist($teamdriver_6);
        $manager->persist($teamdriver_7);
        $manager->persist($race_1);
        $manager->persist($race_2);
        $manager->persist($race_3);
        $manager->persist($race_4);
        $manager->persist($entrylist_1_1);
        $manager->persist($entrylist_1_2);
        $manager->persist($entrylist_1_3);
        $manager->persist($entrylist_2_1);
        $manager->persist($entrylist_2_2);
        $manager->persist($entrylist_2_3);
        $manager->persist($entrylist_3_1);
        $manager->persist($entrylist_3_2);
        $manager->persist($entrylist_3_3);
        $manager->persist($championship);
        $manager->persist($championshipEntry_1);
        $manager->persist($championshipEntry_2);
        $manager->persist($championshipEntry_3);
        $manager->flush();
    }

    public function mailFormer(User $user): string {
        return strtolower($this->stripAccents($user->getName())).strtolower($this->stripAccents($user->getLastname()));
    }

    public function stripAccents($original): string {
        $accents = '/&([A-Za-z]{1,2})(grave|acute|circ|cedil|uml|lig);/';
        $string_encoded = htmlentities($original,ENT_NOQUOTES,'UTF-8');
        $new = preg_replace($accents,'$1',$string_encoded);
        return $new;
    }
}
