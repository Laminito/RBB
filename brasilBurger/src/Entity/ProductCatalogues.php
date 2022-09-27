<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use App\Entity\ProductCatalogues;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ProductCataloguesRepository;

#[ORM\Entity(repositoryClass: ProductCataloguesRepository::class)]
#[ApiResource(
    collectionOperations:   [
        "get" => [
            'status'=>Response::HTTP_OK,
            'path' =>"/ProductCatalogues",
            'normalization_context'=>['groups'=>['catalogue:read']]
      ],
    ],
    itemOperations:         [],
  
  )]
class ProductCatalogues
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ApiProperty(identifier:true)]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
