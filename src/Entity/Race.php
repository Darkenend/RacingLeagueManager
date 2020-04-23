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
}
