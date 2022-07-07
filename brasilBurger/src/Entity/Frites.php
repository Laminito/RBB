<?php

namespace App\Entity;

use App\Entity\Menu;
use App\Entity\Product;
use App\Entity\Complement;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FritesRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;


#[ORM\Entity(repositoryClass: FritesRepository::class)]
#[ApiResource(
     collectionOperations:   [
         "get"=>[
             'method' => 'get',
             'status' => Response::HTTP_OK,
             'normalization_context' => ['groups' => ['Frites:read:simple']],
         ],
         "post"
     ],
     itemOperations:         ["put","get","delete"],
    )]
class Frites extends Product
{
    #[ORM\OneToMany(mappedBy: 'frites', targetEntity: QuantiteFrite::class)]

    public function __construct()
    {
        parent::__construct();
       
    }

}
