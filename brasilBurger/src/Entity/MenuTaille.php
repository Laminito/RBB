<?php

namespace App\Entity;

use App\Entity\Menu;
use App\Entity\Taille;
use App\Entity\Boissontaille;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use App\Repository\MenuTailleRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: MenuTailleRepository::class)]
#[ApiResource(

)]
class MenuTaille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    
    // #[Groups(['Menu:write','Menu:read:simple','Menu:read:all'])]
    private $id;
    
    #[Groups(['Menu:write','Menu:read:simple','Menu:read:all','Menu:read:id'])]
    #[ORM\Column(type: 'integer', nullable: true)]
    // #[SerializedName('QuantiteTailleBoissons')]
    private $qttailles;

    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'menutailles',cascade:["persist"])]
    private $menu;

    #[ORM\ManyToOne(targetEntity: Taille::class, inversedBy: 'menutailles',cascade:["persist"])]
    // #[Groups(['Menu:write','Menu:read:simple','Menu:read:all','Product:read:simple'])]
    // #[SerializedName('Tailles')]
    private $taille;

    #[ORM\ManyToOne(inversedBy: 'menuTailles',cascade:["persist"])]
    #[Groups(['catalogue:read','Menu:write','Menu:read:simple','Menu:read:all'])]
    private ?Boissontaille $boissonTaille = null;

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

    public function getBoissonTaille(): ?Boissontaille
    {
        return $this->boissonTaille;
    }

    public function setBoissonTaille(?Boissontaille $boissonTaille): self
    {
        $this->boissonTaille = $boissonTaille;

        return $this;
    }
}
