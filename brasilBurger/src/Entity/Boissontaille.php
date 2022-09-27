<?php

namespace App\Entity;

use App\Entity\Taille;
use App\Entity\Boisson;
use App\Entity\Boissontaille;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BoissontailleRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BoissontailleRepository::class)]
#[ApiResource(
    collectionOperations:   [
        "get"=>[
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['Boissontaille:read:simple']],
        ],
        
        "post"=>[
            'method' => 'post',
            'normalization_context' => ['groups' => ['Boissontaille:read:all']],
            'denormalization_context' => ['groups' => ['Boissontaille:write']],
        ],
    ],
    itemOperations:         ["put","get","delete"],
)]
class Boissontaille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['catalogue:read','Menu:write','Menu:read:all','Menu:read:simple','Boissontaille:read:simple','Boissontaille:read:all'])] 
    private ?int $id = null;

    #[Groups(['catalogue:read','Boissontaille:write','Boissontaille:read:simple','Boissontaille:read:all'])]
    #[ORM\Column(nullable: true)]
    private ?int $prixbt = null;

    #[Groups(['catalogue:read','Boissontaille:write','Boissontaille:read:simple','Boissontaille:read:all'])]
    #[ORM\ManyToOne(inversedBy: 'boissontailles',cascade:['persist'])]
    private ?Boisson $boisson = null;

    #[Groups(['Boissontaille:write','Boissontaille:read:simple','Boissontaille:read:all'])]
    #[ORM\ManyToOne(inversedBy: 'boissontailles',cascade:['persist'])]
    private ?Taille $taille = null;

    #[ORM\OneToMany(mappedBy: 'boissonTaille', targetEntity: MenuTaille::class)]
    private Collection $menuTailles;


    public function __construct()
    {
        $this->menuTailles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixbt(): ?int
    {
        return $this->prixbt;
    }

    public function setPrixbt(?int $prixbt): self
    {
        $this->prixbt = $prixbt;

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

    /**
     * @return Collection<int, MenuTaille>
     */
    public function getMenuTailles(): Collection
    {
        return $this->menuTailles;
    }

    public function addMenuTaille(MenuTaille $menuTaille): self
    {
        if (!$this->menuTailles->contains($menuTaille)) {
            $this->menuTailles->add($menuTaille);
            $menuTaille->setBoissonTaille($this);
        }

        return $this;
    }

    public function removeMenuTaille(MenuTaille $menuTaille): self
    {
        if ($this->menuTailles->removeElement($menuTaille)) {
            // set the owning side to null (unless already changed)
            if ($menuTaille->getBoissonTaille() === $this) {
                $menuTaille->setBoissonTaille(null);
            }
        }

        return $this;
    }

  

}
