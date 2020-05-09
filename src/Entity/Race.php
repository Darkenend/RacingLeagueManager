<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RaceRepository")
 */
class Race
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $track;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Championship", inversedBy="races")
     */
    private $championship_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TeamEntryList", mappedBy="race_id")
     */
    private $teamEntryLists;

    /**
     * @ORM\Column(type="integer")
     */
    private $ambientTemp;

    /**
     * @ORM\Column(type="float")
     */
    private $cloudLevel;

    /**
     * @ORM\Column(type="float")
     */
    private $rain;

    /**
     * @ORM\Column(type="integer")
     */
    private $practice_hour;

    /**
     * @ORM\Column(type="integer")
     */
    private $practice_length;

    /**
     * @ORM\Column(type="integer")
     */
    private $qualy_hour;

    /**
     * @ORM\Column(type="integer")
     */
    private $qualy_length;

    /**
     * @ORM\Column(type="integer")
     */
    private $race_hour;

    /**
     * @ORM\Column(type="integer")
     */
    private $race_length;

    public function __construct()
    {
        $this->teamEntryLists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrack(): ?string
    {
        return $this->track;
    }

    public function setTrack(string $track): self
    {
        $this->track = $track;

        return $this;
    }

    public function getChampionshipId(): ?Championship
    {
        return $this->championship_id;
    }

    public function setChampionshipId(?Championship $championship_id): self
    {
        $this->championship_id = $championship_id;

        return $this;
    }

    /**
     * @return Collection|TeamEntryList[]
     */
    public function getTeamEntryLists(): Collection
    {
        return $this->teamEntryLists;
    }

    public function addTeamEntryList(TeamEntryList $teamEntryList): self
    {
        if (!$this->teamEntryLists->contains($teamEntryList)) {
            $this->teamEntryLists[] = $teamEntryList;
            $teamEntryList->setRaceId($this);
        }

        return $this;
    }

    public function removeTeamEntryList(TeamEntryList $teamEntryList): self
    {
        if ($this->teamEntryLists->contains($teamEntryList)) {
            $this->teamEntryLists->removeElement($teamEntryList);
            // set the owning side to null (unless already changed)
            if ($teamEntryList->getRaceId() === $this) {
                $teamEntryList->setRaceId(null);
            }
        }

        return $this;
    }

    public function getAmbientTemp(): ?int
    {
        return $this->ambientTemp;
    }

    public function setAmbientTemp(int $ambientTemp): self
    {
        $this->ambientTemp = $ambientTemp;

        return $this;
    }

    public function getCloudLevel(): ?float
    {
        return $this->cloudLevel;
    }

    public function setCloudLevel(float $cloudLevel): self
    {
        $this->cloudLevel = $cloudLevel;

        return $this;
    }

    public function getRain(): ?float
    {
        return $this->rain;
    }

    public function setRain(float $rain): self
    {
        $this->rain = $rain;

        return $this;
    }

    public function getPracticeHour(): ?int
    {
        return $this->practice_hour;
    }

    public function setPracticeHour(int $practice_hour): self
    {
        $this->practice_hour = $practice_hour;

        return $this;
    }

    public function getPracticeLength(): ?int
    {
        return $this->practice_length;
    }

    public function setPracticeLength(int $practice_length): self
    {
        $this->practice_length = $practice_length;

        return $this;
    }

    public function getQualyHour(): ?int
    {
        return $this->qualy_hour;
    }

    public function setQualyHour(int $qualy_hour): self
    {
        $this->qualy_hour = $qualy_hour;

        return $this;
    }

    public function getQualyLength(): ?int
    {
        return $this->qualy_length;
    }

    public function setQualyLength(int $qualy_length): self
    {
        $this->qualy_length = $qualy_length;

        return $this;
    }

    public function getRaceHour(): ?int
    {
        return $this->race_hour;
    }

    public function setRaceHour(int $race_hour): self
    {
        $this->race_hour = $race_hour;

        return $this;
    }

    public function getRaceLength(): ?int
    {
        return $this->race_length;
    }

    public function setRaceLength(int $race_length): self
    {
        $this->race_length = $race_length;

        return $this;
    }
}
