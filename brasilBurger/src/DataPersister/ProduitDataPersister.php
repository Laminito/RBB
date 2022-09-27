<?php

namespace App\DataPersister;


use App\Entity\Menu;
use App\Entity\Burger;
use App\Entity\Frites;
use App\Entity\Boisson;
use App\Entity\Product;
use App\Entity\Products;
use App\Entity\Boissontaille;
use App\Entity\ProductCatalogues;
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

        return $data instanceof Product or $data instanceof Boisson or $data instanceof Frites or $data instanceof Burger or $data instanceof Menu or $data instanceof ProductCatalogues ;
    }

   
    public function persist($data, array $context = []){
        if($data->getImageTaupe()){
            $conv=$data->getImageTaupe();
            // dd($data->setImage(file_get_contents($conv)));
            $afterConv=$data->setImage(file_get_contents($conv));
            $this->entityManager->persist($afterConv);
            $this->entityManager->flush();
           
        }

    }

    public function remove($data, array $context = []){

    }

}