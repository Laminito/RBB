<?php

namespace App\Entity;

use App\Entity\Livreur;
use App\Entity\Commande;
use App\Entity\Livraison;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\LivraisonRepository;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $durerLivraison;

    #[ORM\OneToMany(mappedBy: 'livraison', targetEntity: Commande::class)]
    private $commandes;

    #[ORM\ManyToOne(targetEntity: Livreur::class, inversedBy: 'livraisons')]
    private $livreur;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDurerLivraison(): ?\DateTimeInterface
    {
        return $this->durerLivraison;
    }

    public function setDurerLivraison(?\DateTimeInterface $durerLivraison): self
    {
        $this->durerLivraison = $durerLivraison;

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
            $commande->setLivraison($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getLivraison() === $this) {
                $commande->setLivraison(null);
            }
        }

        return $this;
    }

    public function getLivreur(): ?Livreur
    {
        return $this->livreur;
    }

    public function setLivreur(?Livreur $livreur): self
    {
        $this->livreur = $livreur;

        return $this;
    }
}
