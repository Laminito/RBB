<?php

namespace App\Entity;

use App\Entity\Menu;
use BurgerController;
use App\Entity\Burger;
use App\Entity\Product;
use App\Entity\Gestionnaire;
use App\Entity\QuantiteBurger;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BurgerRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\DependencyInjection\Loader\Configurator\security;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
#[ApiResource(
 collectionOperations:   [
                    "get"=>[
                        'method' => 'get',
                        'status' => Response::HTTP_OK,
                        'normalization_context' => ['groups' => ['Burger:read:simple']],
                    ],
                  
                    "post"=>[
                        'method' => 'post',
                        'normalization_context' => ['groups' => ['Burger:read:all']],
                         'denormalization_context' => ['groups' => ['Burger:write']]
                    ],
                     "add" => [
                         'method' => 'Post',
                         "path"=>"/add",
                         "controller"=>BurgerController::class,
                         ]
                ],
 itemOperations:         [
                    "delete",
                     "put",
                    "put" => [
                        "method" => "put",
                        "security" => "is_granted('ROLE_GESTIONNAIRE')",
                        "security_message" => "Vous n'êtes pas autorisé !",
                       
                   ],
                   "get"=>[
                       'method' => 'get',
                       'status' => Response::HTTP_OK,
                       'normalization_context' => ['groups' => ['Burger:read:all']],
                   ],  
               ],
)]

class Burger extends Product
{
    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'burgers')]
    // #[Groups(['Burger:read:all'])]
    private $gestionnaire;

   

    public function __construct()
    {
       
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


}
