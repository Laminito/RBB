<?php   
namespace App\Entity;

use App\Entity\ProduitCatalogue;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource(
  normalizationContext:["groups"=>["group:catalogue"]],
  collectionOperations:   [
    "get" => [
      "path" =>"/ProduitCatalogue"
    ],
  ],
  itemOperations: []
)]
class ProduitCatalogue{
    #[ApiProperty(identifier:true)]
    private $id;

  }