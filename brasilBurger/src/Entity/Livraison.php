<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'time', nullable: true)]
    private $durer;

    #[ORM\OneToMany(mappedBy: 'livraisons', targetEntity: Commande::class)]
    private $commandes;

    #[ORM\ManyToOne(targetEntity: Livreur::class, inversedBy: 'livraisons')]
    private $livreurs;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDurer(): ?\DateTimeInterface
    {
        return $this->durer;
    }

    public function setDurer(?\DateTimeInterface $durer): self
    {
        $this->durer = $durer;

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
            $commande->setLivraisons($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getLivraisons() === $this) {
                $commande->setLivraisons(null);
            }
        }

        return $this;
    }

    public function getLivreurs(): ?Livreur
    {
        return $this->livreurs;
    }

    public function setLivreurs(?Livreur $livreurs): self
    {
        $this->livreurs = $livreurs;

        return $this;
    }

}
