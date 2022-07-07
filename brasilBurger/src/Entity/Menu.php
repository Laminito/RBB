<?php

namespace App\Entity;

use App\Entity\Menu;
use App\Entity\Burger;
use App\Entity\Frites;
use App\Entity\Boisson;
use App\Entity\Product;
use App\Entity\Gestionnaire;
use App\Entity\QuantiteFrite;
use App\Entity\QuantiteBurger;
use App\Entity\QuantiteBoisson;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
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


    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'menus')]
    #[Groups(['Menu:read:simple'])]
    private $gestionnaire;

    #[ORM\Column(type: 'float', nullable: true)]
    #[Groups(['Menu:read:simple'])]
    private $prixMenu;

    #[ORM\ManyToMany(targetEntity: Boisson::class, inversedBy: 'menus')]
    private $boissons;

  

    public function __construct()
    {
        parent::__construct();
       
      
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


    public function getGestionnaire(): ?Gestionnaire
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(?Gestionnaire $gestionnaire): self
    {
        $this->gestionnaire = $gestionnaire;

        return $this;
    }


  
    #[Groups(['Menu:read:simple'])]
    public function getPrixMenu(): void
    {

        $add = $this->qtburgers->toArray();
        dd($this);
        // foreach ($add as $value){
        //     $this->$value.getPrix();
        //     $this->$value.getQtburgers();
        // }
        // foreach ()
        // $reduction = 0.05;
        // $prixFinal=$this->totalBoisson()+$this->totalBurger()+$this->totalFrite() * $reduction;
        
        $this->setPrix($prixFinal);
        
    }

    public function setPrixMenu(?float $prixMenu): self
    {
        $this->prixMenu= $prixMenu ;

        return $this;
    }

    // public function totalBurger(){
        // return array_reduce($this->qtburgers->toArray(),
        //  function($totalBurger,$qtburgers){
             
        //     return $totalBurger+$qtburgers->getPrix();
        // },0);


    // }

    // public function totalBoisson(){
    //     return array_reduce($this->qtBoissons->toArray(),
    //      function($totalBoisson ,$qtBoissons){
    //         return $totalBoisson+$qtBoissons->getPrix();
    //     },0);
    // }
    
    // public function totalFrite(){
    //     return array_reduce($this->qtfrites->toArray(),
    //      function($totalFrite ,$qtfrites){
    //         return $totalFrite+$qtfrites->getPrix()*get;
    //     },0);
    // }

}