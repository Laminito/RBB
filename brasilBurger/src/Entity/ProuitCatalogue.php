<?php   
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource(
  collectionOperations:   [
    "get" => [
      "path" =>"/ProduitCatalogue"
    ],
  ]
)]
class ProduitCatalogue{
    #[ApiProperty(identifier:true)]
    private $id;

  }