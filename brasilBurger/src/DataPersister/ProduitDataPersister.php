<?php

namespace App\DataPersister;


use App\Entity\Product;

use Doctrine\ORM\EntityManagerInterface;
use App\DataPersister\ProduitDataPersister;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;


class ProduitDataPersister implements ContextAwareDataPersisterInterface
{
    private $entityManager;
   
    public function __construct( EntityManagerInterface $entityManager)
    {
      
        $this->entityManager = $entityManager;
    }
    public function supports($data, array $context = []): bool{

        return $data instanceof Product;
    }

   
    public function persist($data, array $context = []){
        if($data->getImageTaupe()){
            $conv=$data->getImageTaupe();
            $afterConv=$data->setImage(file_get_contents($conv));
            $this->entityManager->persist($afterConv);
            $this->entityManager->flush();
            // dd($afterConv);
        }

    }

    public function remove($data, array $context = []){

    }

}