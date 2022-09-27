<?php

namespace App\DataPersister;

use App\Entity\Menu;
use App\Entity\Product;
use App\Entity\Commande;
use App\Entity\MenuFrites;
use App\Entity\LigneDeCommande;
use App\DataPersister\LDCDataPersister;
use App\DataPersister\MenuDataPersister;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;


class MenuDataPersister implements ContextAwareDataPersisterInterface
{

    private $entityManager;
   
    public function __construct( EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function supports($data, array $context = []): bool{

        return $data instanceof Menu;
    }
    
    
    public function persist($data, array $context = []){
        
        if($data->getImageTaupe()){
            $conv=$data->getImageTaupe();
            $afterConv=$data->setImage(file_get_contents($conv));}
            
            $qf =$data->getMenuFrites();
            $qb =$data->getMenuBurgers(); 
            $qbs=$data->getMenutailles();
           
            foreach($qf as $qfs){
                $quantitefrites=$qfs->getQtfrites();
                $prixfrites=$qfs->getFrite()->getPrix();
                $totalF=$quantitefrites*$prixfrites;
           }
        
        
           foreach($qb as $q){
               $quantiteburgers=$q->getQtburgers();
               $prixburger=$q->getBurger()->getPrix();
               $totalB=$quantiteburgers*$prixburger;   
           }
      
        
           foreach($qbs as $b){
                $quantiteboissons=$b->getQttailles();
                $prixboisson=$b->getBoissontaille()->getPrixbt();
                $totalBs=$quantiteboissons*$prixboisson;
          }
        
        
        $prixMenu=($totalF+$totalB+$totalBs)-0.05;
        $prix = $data->setPrix($prixMenu);
     
        $this->entityManager->persist($prix);
        $this->entityManager->flush();
        // dd($data);
        }
        

    public function remove($data, array $context = []){

    }

}