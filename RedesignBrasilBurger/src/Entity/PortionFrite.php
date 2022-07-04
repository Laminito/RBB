<?php

namespace App\Entity;

use App\Entity\Menu;
use App\Entity\Produit;
use App\Entity\PortionFrite;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToOne;
use App\Repository\PortionFriteRepository;

#[ORM\Entity(repositoryClass: PortionFriteRepository::class)]
class PortionFrite extends Produit
{
    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'portionFrites')]
    private $menu;

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }
}
