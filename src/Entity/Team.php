<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ChampionshipEntries", mappedBy="team")
     */
    private $championshipEntries;

    /**
     * @ORM\Column(type="integer")
     */
    private $privacy;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TeamDrivers", mappedBy="team")
     */
    private $teamDrivers;

    public function __construct()
    {
        $this->championshipEntries = new ArrayCollection();
        $this->teamDrivers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    /**
     * @return Collection|ChampionshipEntries[]
     */
    public function getChampionshipEntries(): Collection
    {
        return $this->championshipEntries;
    }

    public function addChampionshipEntry(ChampionshipEntries $championshipEntry): self
    {
        if (!$this->championshipEntries->contains($championshipEntry)) {
            $this->championshipEntries[] = $championshipEntry;
            $championshipEntry->setTeam($this);
        }

        return $this;
    }

    public function removeChampionshipEntry(ChampionshipEntries $championshipEntry): self
    {
        if ($this->championshipEntries->contains($championshipEntry)) {
            $this->championshipEntries->removeElement($championshipEntry);
            // set the owning side to null (unless already changed)
            if ($championshipEntry->getTeam() === $this) {
                $championshipEntry->setTeam(null);
            }
        }

        return $this;
    }

    public function getPrivacy(): ?int
    {
        return $this->privacy;
    }

    public function setPrivacy(int $privacy): self
    {
        $this->privacy = $privacy;

        return $this;
    }

    /**
     * @return Collection|TeamDrivers[]
     */
    public function getTeamDrivers(): Collection
    {
        return $this->teamDrivers;
    }

    public function addTeamDriver(TeamDrivers $teamDriver): self
    {
        if (!$this->teamDrivers->contains($teamDriver)) {
            $this->teamDrivers[] = $teamDriver;
            $teamDriver->setTeam($this);
        }

        return $this;
    }

    public function removeTeamDriver(TeamDrivers $teamDriver): self
    {
        if ($this->teamDrivers->contains($teamDriver)) {
            $this->teamDrivers->removeElement($teamDriver);
            // set the owning side to null (unless already changed)
            if ($teamDriver->getTeam() === $this) {
                $teamDriver->setTeam(null);
            }
        }

        return $this;
    }
}
