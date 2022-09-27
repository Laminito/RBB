<?php

namespace App\Entity;

use App\Entity\Menu;
use App\Entity\Taille;
use App\Entity\Boisson;
use App\Entity\Product;
use App\Entity\Complement;
use App\Entity\Boissontaille;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use App\Repository\BoissonRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: BoissonRepository::class)]
#[ApiResource(
     collectionOperations:   [
         "get"=>[
             'method' => 'get',
             'status' => Response::HTTP_OK,
             'normalization_context' => ['groups' => ['Boisson:read:simple']],
         ],
         "post"=>[
             'method' => 'post',
             'normalization_context' => ['groups' => ['Boisson:read:all']],
             'denormalization_context' => ['groups' => ['Boisson:write']],
         ]
     ],
     itemOperations:         ["put","get","delete"],
    )
    ]
class Boisson extends Product
{
    // #[Groups(['Boissontaille:write','Boissontaille:read:simple','Boissontaille:read:all'])]
    #[ORM\OneToMany(mappedBy: 'boisson', targetEntity: Boissontaille::class,cascade:['persist'])]
    private Collection $boissontailles;

    public function __construct()
    {
        parent::__construct();
    
        // $this->taille = new ArrayCollection();
        $this->boissontailles = new ArrayCollection();
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
            $boissontaille->setBoisson($this);
        }

        return $this;
    }

    public function removeBoissontaille(Boissontaille $boissontaille): self
    {
        if ($this->boissontailles->removeElement($boissontaille)) {
            // set the owning side to null (unless already changed)
            if ($boissontaille->getBoisson() === $this) {
                $boissontaille->setBoisson(null);
            }
        }

        return $this;
    }
   
}
