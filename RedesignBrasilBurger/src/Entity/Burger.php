<?php

namespace App\Entity;

use App\Entity\Menu;
use App\Entity\Burger;
use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\BurgerRepository;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
class Burger extends  Produit
{

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $categorieBurger;

    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'burgers')]
    private $menus;

    public function __construct()
    {
        parent::__construct();
        $this->menus = new ArrayCollection();
    }


    public function getCategorieBurger(): ?string
    {
        return $this->categorieBurger;
    }

    public function setCategorieBurger(?string $categorieBurger): self
    {
        $this->categorieBurger = $categorieBurger;

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
            $menu->addBurger($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            $menu->removeBurger($this);
        }

        return $this;
    }
}
