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
     * @ORM\ManyToMany(targetEntity="App\Entity\Championship", mappedBy="teams")
     */
    private $championships;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="teams")
     */
    private $drivers;

    public function __construct()
    {
        $this->championships = new ArrayCollection();
        $this->drivers = new ArrayCollection();
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
     * @return Collection|Championship[]
     */
    public function getChampionships(): Collection
    {
        return $this->championships;
    }

    public function addChampionship(Championship $championship): self
    {
        if (!$this->championships->contains($championship)) {
            $this->championships[] = $championship;
            $championship->addTeam($this);
        }

        return $this;
    }

    public function removeChampionship(Championship $championship): self
    {
        if ($this->championships->contains($championship)) {
            $this->championships->removeElement($championship);
            $championship->removeTeam($this);
        }

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
}
