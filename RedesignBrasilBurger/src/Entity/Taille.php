<?php

namespace App\Entity;

use App\Entity\Taille;
use Doctrine\ORM\Mapping\Id;
use App\Entity\BoissonTaille;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use App\Repository\TailleRepository;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: TailleRepository::class)]
class Taille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $model;

    #[ORM\OneToMany(mappedBy: 'taille', targetEntity: BoissonTaille::class)]
    private $boissonTailles;

    public function __construct()
    {
        $this->boissonTailles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return Collection<int, BoissonTaille>
     */
    public function getBoissonTailles(): Collection
    {
        return $this->boissonTailles;
    }

    public function addBoissonTaille(BoissonTaille $boissonTaille): self
    {
        if (!$this->boissonTailles->contains($boissonTaille)) {
            $this->boissonTailles[] = $boissonTaille;
            $boissonTaille->setTaille($this);
        }

        return $this;
    }

    public function removeBoissonTaille(BoissonTaille $boissonTaille): self
    {
        if ($this->boissonTailles->removeElement($boissonTaille)) {
            // set the owning side to null (unless already changed)
            if ($boissonTaille->getTaille() === $this) {
                $boissonTaille->setTaille(null);
            }
        }

        return $this;
    }
}
