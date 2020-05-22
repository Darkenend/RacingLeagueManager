<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamEntryListRepository")
 */
class TeamEntryList
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Race", inversedBy="teamEntryLists")
     * @ORM\JoinColumn(nullable=false)
     */
    private $race_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $racenumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $carmodel;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $result;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bestlap;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Laps;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaceId(): ?Race
    {
        return $this->race_id;
    }

    public function setRaceId(?Race $race_id): self
    {
        $this->race_id = $race_id;

        return $this;
    }

    public function getTeamId(): ?Team
    {
        return $this->team_id;
    }

    public function setTeamId(?Team $team_id): self
    {
        $this->team_id = $team_id;

        return $this;
    }

    public function getResult(): ?int
    {
        return $this->result;
    }


    public function getRacenumber(): ?int
    {
        return $this->racenumber;
    }

    public function setRacenumber(int $racenumber): self
    {
        $this->racenumber = $racenumber;

        return $this;
    }

    public function getCarmodel(): ?int
    {
        return $this->carmodel;
    }

    public function setCarmodel(int $carmodel): self
    {
        $this->carmodel = $carmodel;

        return $this;
    }

    public function setResult(?int $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getBestlap(): ?int
    {
        return $this->bestlap;
    }

    public function setBestlap(?int $bestlap): self
    {
        $this->bestlap = $bestlap;

        return $this;
    }

    public function getLaps(): ?int
    {
        return $this->Laps;
    }

    public function setLaps(?int $Laps): self
    {
        $this->Laps = $Laps;

        return $this;
    }
}
