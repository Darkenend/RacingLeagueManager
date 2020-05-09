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
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="teams")
     */
    private $drivers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ChampionshipEntries", mappedBy="team")
     */
    private $championshipEntries;

    public function __construct()
    {
        $this->drivers = new ArrayCollection();
        $this->championshipEntries = new ArrayCollection();
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
     * @return Collection|User[]
     */
    public function getDrivers(): Collection
    {
        return $this->drivers;
    }

    public function addDriver(User $driver): self
    {
        if (!$this->drivers->contains($driver)) {
            $this->drivers[] = $driver;
            $driver->addTeam($this);
        }

        return $this;
    }

    public function removeDriver(User $driver): self
    {
        if ($this->drivers->contains($driver)) {
            $this->drivers->removeElement($driver);
            $driver->removeTeam($this);
        }

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
}
