<?php

namespace App\Entity;

use App\Entity\Zone;
use App\Entity\Quartier;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToOne;
use App\Repository\QuartierRepository;
use Doctrine\ORM\Mapping\GeneratedValue;

#[ORM\Entity(repositoryClass: QuartierRepository::class)]
class Quartier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $libelle;

    #[ORM\ManyToOne(targetEntity: Zone::class, inversedBy: 'quartiers')]
    private $zone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getZone(): ?Zone
    {
        return $this->zone;
    }

    public function setZone(?Zone $zone): self
    {
        $this->zone = $zone;

        return $this;
    }
}
