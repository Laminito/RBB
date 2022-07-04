<?php

namespace App\Entity;

use App\Entity\Taille;
use App\Entity\Boisson;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use App\Repository\BoissonTailleRepository;

#[ORM\Entity(repositoryClass: BoissonTailleRepository::class)]
class BoissonTaille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float', nullable: true)]
    private $prixUnitaireSelonLaTailleDuBoisson;

    #[ORM\ManyToOne(targetEntity: Boisson::class, inversedBy: 'boissonTailles')]
    private $boisson;

    #[ORM\ManyToOne(targetEntity: Taille::class, inversedBy: 'boissonTailles')]
    private $taille;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixUnitaireSelonLaTailleDuBoisson(): ?float
    {
        return $this->prixUnitaireSelonLaTailleDuBoisson;
    }

    public function setPrixUnitaireSelonLaTailleDuBoisson(?float $prixUnitaireSelonLaTailleDuBoisson): self
    {
        $this->prixUnitaireSelonLaTailleDuBoisson = $prixUnitaireSelonLaTailleDuBoisson;

        return $this;
    }

    public function getBoisson(): ?Boisson
    {
        return $this->boisson;
    }

    public function setBoisson(?Boisson $boisson): self
    {
        $this->boisson = $boisson;

        return $this;
    }

    public function getTaille(): ?Taille
    {
        return $this->taille;
    }

    public function setTaille(?Taille $taille): self
    {
        $this->taille = $taille;

        return $this;
    }
}
