<?php

namespace App\Entity;

use App\Entity\Menu;
use App\Entity\Taille;
use App\Entity\Product;
use App\Entity\Complement;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BoissonRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BoissonRepository::class)]
#[ApiResource(
     collectionOperations:   [
         "get"=>[
             'method' => 'get',
             'status' => Response::HTTP_OK,
             'normalization_context' => ['groups' => ['Boisson:read:simple']],
         ],
         "post"
     ],
     itemOperations:         ["put","get","delete"],
    )]
class Boisson extends Product
{
    // #[Groups(['Menu:read:simple'])]
    private $boissontailles;

    public function __construct()
    {
        $this->boissontailles = new ArrayCollection();
       
       
    }

    /**
     * @return Collection<int, BoissonTaille>
     */
    public function getBoissontailles(): Collection
    {
        return $this->boissontailles;
    }

    public function addBoissontaille(BoissonTaille $boissontaille): self
    {
        if (!$this->boissontailles->contains($boissontaille)) {
            $this->boissontailles[] = $boissontaille;
            $boissontaille->setBoisson($this);
        }

        return $this;
    }

    public function removeBoissontaille(BoissonTaille $boissontaille): self
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
