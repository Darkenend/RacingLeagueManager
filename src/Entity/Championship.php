<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChampionshipRepository")
 */
class Championship
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Race", mappedBy="championship_id")
     */
    private $races;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ChampionshipEntries", mappedBy="championship")
     * @ORM\OrderBy({"points" = "DESC"})
     */
    private $championshipEntries;

    public function __construct()
    {
        $this->races = new ArrayCollection();
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
     * @return Collection|Race[]
     */
    public function getRaces(): Collection
    {
        return $this->races;
    }

    public function addRace(Race $race): self
    {
        if (!$this->races->contains($race)) {
            $this->races[] = $race;
            $race->setChampionshipId($this);
        }

        return $this;
    }

    public function removeRace(Race $race): self
    {
        if ($this->races->contains($race)) {
            $this->races->removeElement($race);
            // set the owning side to null (unless already changed)
            if ($race->getChampionshipId() === $this) {
                $race->setChampionshipId(null);
            }
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
            $championshipEntry->setChampionship($this);
        }

        return $this;
    }

    public function removeChampionshipEntry(ChampionshipEntries $championshipEntry): self
    {
        if ($this->championshipEntries->contains($championshipEntry)) {
            $this->championshipEntries->removeElement($championshipEntry);
            // set the owning side to null (unless already changed)
            if ($championshipEntry->getChampionship() === $this) {
                $championshipEntry->setChampionship(null);
            }
        }

        return $this;
    }
}
