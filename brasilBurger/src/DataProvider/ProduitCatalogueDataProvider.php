<?php

namespace App\DataProvider;

use Doctrine\ORM\Mapping\Entity;
use App\Repository\MenuRepository;
use App\Repository\BurgerRepository;
use App\DataProvider\ProduitCatalogueDataProvider;
use ApiPlatform\Core\DataProvider\RestrictionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;

class ProduitCatalogueDataProvider implements ContextAwareCollectionDataProviderInterface{

    public function __construct(MenuRepository $menuRepo,BurgerRepository $burgerRepo){
        $this->menuRepo= $menuRepo;
        $this->burgerRepo= $burgerRepo;

        // dd($this->menuRepo->findAll());
    }

   /**
     * {@inheritdoc}
     */
    public function getCollection(string $ressourceClass, string $operationName = null, array $context = []){

        
        $context['menu'] = $this->menuRepo->findAll();
        $context['burger'] = $this->burgerRepo->findAll();
        // dd($context);
        $catalogue=[];
        $catalogue['menu'] = $this->menuRepo->findAll();
        return $context;
    }

    public function supports(string $ressourceClass, string $operationName = null, array $context = []):bool{


        return $ressourceClass = ProduitCatalogue:: class;
    }

}