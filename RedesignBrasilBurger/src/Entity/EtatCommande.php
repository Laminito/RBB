<?php

namespace App\Entity;

use App\Entity\Commande;
use App\Entity\EtatCommande;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToMany;
use App\Repository\EtatCommandeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: EtatCommandeRepository::class)]
class EtatCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $etatCommande;

    #[ORM\OneToMany(mappedBy: 'etatCommande', targetEntity: Commande::class)]
    private $commandes;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isEtatCommande(): ?bool
    {
        return $this->etatCommande;
    }

    public function setEtatCommande(?bool $etatCommande): self
    {
        $this->etatCommande = $etatCommande;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setEtatCommande($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getEtatCommande() === $this) {
                $commande->setEtatCommande(null);
            }
        }

        return $this;
    }
}
