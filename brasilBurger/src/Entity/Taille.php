<?php

namespace App\Entity;

use App\Entity\Taille;
use App\Entity\MenuTaille;
use App\Entity\BoissonTaille;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToMany;
use App\Repository\TailleRepository;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TailleRepository::class)]

#[ApiResource(
    
        collectionOperations:   [
        "get"=>[
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['Taille:read:simple']],
        ],
        
        "post"=>[
            'method' => 'post',
            'denormalization_context' => ['groups' => ['Taille:write']],
        ],
    ],
    itemOperations:         ["put","get","delete"],
)]

class Taille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    //  #[Groups(['Taille:write'])]

    #[Groups(['Boissontaille:write','Menu:write','Menu:read:simple','Menu:read:all','Boisson:write'])]
    private $id;

    #[ORM\Column(type: 'string',nullable: true, length: 255)]
    #[Groups(['Taille:read:simple','Taille:write'])]
    private $model;

    #[ORM\OneToMany(mappedBy: 'taille', targetEntity: MenuTaille::class,cascade:["persist"])]
    #[ApiSubresource]
    private $menutailles;

    // #[ORM\OneToMany(mappedBy: 'taille', targetEntity: Boissontaille::class,cascade:['persist'])]
    // private Collection $boissontailles;

    public function __construct()
    {
        
        $this->menutailles = new ArrayCollection();
        $this->boissontailles = new ArrayCollection();
       
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }


     /**
      * @return Collection<int, MenuTaille>
      */
     public function getMenutailles(): Collection
     {
         return $this->menutailles;
     }

     public function addMenutaille(MenuTaille $menutaille): self
     {
         if (!$this->menutailles->contains($menutaille)) {
             $this->menutailles[] = $menutaille;
             $menutaille->setTaille($this);
         }

         return $this;
     }

     public function removeMenutaille(MenuTaille $menutaille): self
     {
         if ($this->menutailles->removeElement($menutaille)) {
             if ($menutaille->getTaille() === $this) {
                 $menutaille->setTaille(null);
             }
         }

         return $this;
     }
    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Boissontaille>
     */
    public function getBoissontailles(): Collection
    {
        return $this->boissontailles;
    }

    public function addBoissontaille(Boissontaille $boissontaille): self
    {
        if (!$this->boissontailles->contains($boissontaille)) {
            $this->boissontailles->add($boissontaille);
            $boissontaille->setTaille($this);
        }

        return $this;
    }

    public function removeBoissontaille(Boissontaille $boissontaille): self
    {
        if ($this->boissontailles->removeElement($boissontaille)) {
            // set the owning side to null (unless already changed)
            if ($boissontaille->getTaille() === $this) {
                $boissontaille->setTaille(null);
            }
        }

        return $this;
    }


}
