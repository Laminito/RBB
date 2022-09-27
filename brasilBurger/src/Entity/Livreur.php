<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Gestionnaire;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\LivreurRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LivreurRepository::class)]
#[ApiResource(
    
    )]
class Livreur extends User
{

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    // #[Groups(['Livreur:read:simple','Livreur:write','Livreur:read:all'])]
    private $telephone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    // #[Groups(['Livreur:read:simple','Livreur:write','Livreur:read:all'])]
    private $matricule;

    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'livreurs')]
    // #[Groups(['Livreur:read:simple','Livreur:write','Livreur:read:all'])]
    private $gestionnaire;

    #[ORM\OneToMany(mappedBy: 'livreurs', targetEntity: Livraison::class)]
   
    private $livraisons;

    public function __construct(){
        parent::__construct();
        $this->roles=['ROLE_LIVREUR'];
        $this->livraisons = new ArrayCollection();
    }


    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(?string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getGestionnaire(): ?Gestionnaire
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(?Gestionnaire $gestionnaire): self
    {
        $this->gestionnaire = $gestionnaire;

        return $this;
    }

    /**
     * @return Collection<int, Livraison>
     */
    public function getLivraisons(): Collection
    {
        return $this->livraisons;
    }

    public function addLivraison(Livraison $livraison): self
    {
        if (!$this->livraisons->contains($livraison)) {
            $this->livraisons[] = $livraison;
            $livraison->setLivreurs($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): self
    {
        if ($this->livraisons->removeElement($livraison)) {
            // set the owning side to null (unless already changed)
            if ($livraison->getLivreurs() === $this) {
                $livraison->setLivreurs(null);
            }
        }

        return $this;
    }
}
