<?php

namespace App\DataPersister;

use App\Entity\Product;
use App\Entity\Commande;
use App\Entity\LigneDeCommande;
use App\DataPersister\LDCDataPersister;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;


class LDCDataPersister implements ContextAwareDataPersisterInterface
{

    private $entityManager;
   
    public function __construct( EntityManagerInterface $entityManager)
    {
      
        $this->entityManager = $entityManager;
    }
    public function supports($data, array $context = []): bool{

        return $data instanceof Commande;
    }

   
    public function persist($data, array $context = []){
        //  dd($data);
        $prixCommande=0;
        $qp=$data->getLignesdecommandes();
      
        foreach($qp as $value) {
            $quantite=$value->getQuantite();
            $prixldc=$value->getProduct()->getPrix();
            $prixCommande+= $quantite*$prixldc;
            }
            $datas = $data->setPrix($prixCommande);
            $this->entityManager->persist($datas);
            $this->entityManager->flush();
        }
            
      

    

     

    public function remove($data, array $context = []){

    }

}