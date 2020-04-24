<?php

namespace App\DataFixtures;

use App\Entity\Championship;
use App\Entity\Race;
use App\Entity\Team;
use App\Entity\TeamEntryList;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /** @noinspection PhpHierarchyChecksInspection
     * @noinspection PhpSignatureMismatchDuringInheritanceInspection
     */
    public function load(ObjectManager $manager)
    {

        // Equipos
        $team_1 = new Team();
        $team_1->setName("Family Sim Racing");
        $team_2 = new Team();
        $team_2->setName("Ingobernables");
        $team_3 = new Team();
        $team_3->setName("Doug Henderson Racing");

        // Usuarios
        $user_1 = new User();
        $user_2 = new User();
        $user_3 = new User();
        $user_4 = new User();
        $user_5 = new User();
        $user_6 = new User();
        $user_1->setRole(1);
        $user_1->setName("Álvaro");
        $user_1->setLastname("Real");
        $user_1->setSteamid("76561191111111111");
        $user_1->setEmail(strtolower($user_1->getName()).strtolower($user_1->getLastname())."@gmail.com");
        $user_1->addTeam($team_1);
        $user_1->addTeam($team_2);
        $user_2->setRole(0);
        $user_2->setName("Javier");
        $user_2->setLastname("Ramirez");
        $user_2->setSteamid("76561191211111111");
        $user_2->setEmail(strtolower($user_2->getName()).strtolower($user_2->getLastname())."@gmail.com");
        $user_2->addTeam($team_1);
        $user_3->setRole(0);
        $user_3->setName("Carlos");
        $user_3->setLastname("Vidal");
        $user_3->setSteamid("76561191311111111");
        $user_3->setEmail(strtolower($user_3->getName()).strtolower($user_3->getLastname())."@gmail.com");
        $user_3->addTeam($team_1);
        $user_4->setRole(0);
        $user_4->setName("Dano");
        $user_4->setLastname("Cumbiote");
        $user_4->setSteamid("76561191411111111");
        $user_4->setEmail(strtolower($user_4->getName()).strtolower($user_4->getLastname())."@gmail.com");
        $user_4->addTeam($team_2);
        $user_5->setRole(0);
        $user_5->setName("Jimmy");
        $user_5->setLastname("Broadbent");
        $user_5->setSteamid("76561191511111111");
        $user_5->setEmail(strtolower($user_5->getName()).strtolower($user_5->getLastname())."@gmail.com");
        $user_5->addTeam($team_3);
        $user_6->setRole(0);
        $user_6->setName("Stephen");
        $user_6->setLastname("Bailey");
        $user_6->setSteamid("76561191611111111");
        $user_6->setEmail(strtolower($user_6->getName()).strtolower($user_6->getLastname())."@gmail.com");
        $user_6->addTeam($team_3);

        // Carreras
        $race_1 = new Race();
        $race_2 = new Race();
        $race_3 = new Race();
        $race_4 = new Race();
        $race_1->setTrack("monza_2019");
        $race_2->setTrack("suzuka_2019");
        $race_3->setTrack("laguna_seca_2019");
        $race_4->setTrack("nurburgring_2019");

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
        $championship->addTeam($team_1);
        $championship->addTeam($team_2);
        $championship->addTeam($team_3);

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
        $manager->flush();
    }
}
