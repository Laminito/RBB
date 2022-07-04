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
    #[ORM\OneToMany(mappedBy: 'boisson', targetEntity: BoissonTaille::class)]
    private $boissontailles;

    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'boissons')]
    private $menus;

    public function __construct()
    {
        $this->boissontailles = new ArrayCollection();
        $this->menus = new ArrayCollection();
       
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

    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
            $menu->addBoisson($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            $menu->removeBoisson($this);
        }

        return $this;
    }
}
