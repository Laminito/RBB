<?php

namespace App\Entity;

use App\Entity\Menu;
use App\Entity\Taille;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use App\Repository\MenuTailleRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: MenuTailleRepository::class)]
#[ApiResource]
class MenuTaille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['Menu:write','Menu:read:simple'])]
    #[SerializedName('QuantiteTailleBoissons')]
    private $qttailles;

    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'menutailles')]
    private $menu;

    #[ORM\ManyToOne(targetEntity: Taille::class, inversedBy: 'menutailles')]
    #[Groups(['Menu:write','Menu:read:simple'])]
    #[SerializedName('Tailles')]
    private $taille;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQttailles(): ?int
    {
        return $this->qttailles;
    }

    public function setQttailles(?int $qttailles): self
    {
        $this->qttailles = $qttailles;

        return $this;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

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
}
