<?php

namespace App\Entity;

use App\Entity\Menu;
use App\Entity\Burger;
use App\Entity\Frites;
use App\Entity\Boisson;
use App\Entity\Product;
use App\Entity\Gestionnaire;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ApiResource(
    collectionOperations:   [
        "get"=>[
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['Menu:read:simple']],
        ],
        "post"
    ],
    itemOperations:         ["put","get","delete"],
    )]

class Menu  extends Product 
{
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['Menu:read:simple'])]
    private $libelle;

    #[ORM\ManyToMany(targetEntity: Burger::class, inversedBy: 'menus')]
    #[ApiSubresource]
    #[Groups(['Menu:read:simple'])]
    private $burgers;

    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'menus')]
    #[Groups(['Menu:read:simple'])]
    private $gestionnaire;

    #[ORM\ManyToMany(targetEntity: Frites::class, inversedBy: 'menus')]
    #[ApiSubresource]
    #[Groups(['Menu:read:simple'])]
    private $frites;

    #[ORM\Column(type: 'float', nullable: true)]
    #[Groups(['Menu:read:simple'])]
    private $prixMenu;

    #[ORM\ManyToMany(targetEntity: Boisson::class, inversedBy: 'menus')]
    private $boissons;

    public function __construct()
    {
        $this->burgers = new ArrayCollection();
        $this->frites = new ArrayCollection();
        $this->boissons = new ArrayCollection();
        
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Burger>
     */
    public function getBurgers(): Collection
    {
        return $this->burgers;
    }

    public function addBurger(Burger $burger): self
    {
        if (!$this->burgers->contains($burger)) {
            $this->burgers[] = $burger;
        }

        return $this;
    }

    public function removeBurger(Burger $burger): self
    {
        $this->burgers->removeElement($burger);

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
     * @return Collection<int, Frites>
     */
    public function getFrites(): Collection
    {
        return $this->frites;
    }

    public function addFrite(Frites $frite): self
    {
        if (!$this->frites->contains($frite)) {
            $this->frites[] = $frite;
        }

        return $this;
    }

    public function removeFrite(Frites $frite): self
    {
        $this->frites->removeElement($frite);

        return $this;
    }

  
    #[Groups(['Menu:read:simple'])]
    public function getPrixMenu(): void
    {
        $reduction = 0.05;
        $prixFinal=$this->totalBoisson()+$this->totalBurger()+$this->totalFrite() * $reduction;
        $this->setPrix($prixFinal);
        
    }

    public function setPrixMenu(?float $prixMenu): self
    {
        $this->prixMenu= $prixMenu ;

        return $this;
    }

    public function totalBurger(){
        return array_reduce($this->burgers->toArray(),
         function($totalBurger,$burger){
            return $totalBurger+$burger->getPrix();
        },0);
    }

    public function totalBoisson(){
        return array_reduce($this->boissons->toArray(),
         function($totalBoisson ,$boisson){
            return $totalBoisson+$boisson->getPrix();
        },0);
    }
    
    public function totalFrite(){
        return array_reduce($this->frites->toArray(),
         function($totalFrite ,$frites){
            return $totalFrite+$frites->getPrix();
        },0);
    }

    /**
     * @return Collection<int, Boisson>
     */
    public function getBoissons(): Collection
    {
        return $this->boissons;
    }

    public function addBoisson(Boisson $boisson): self
    {
        if (!$this->boissons->contains($boisson)) {
            $this->boissons[] = $boisson;
        }

        return $this;
    }

    public function removeBoisson(Boisson $boisson): self
    {
        $this->boissons->removeElement($boisson);

        return $this;
    }
}