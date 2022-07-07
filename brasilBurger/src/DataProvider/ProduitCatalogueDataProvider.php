<?php

namespace App\DataProvider;

use Doctrine\ORM\Mapping\Entity;
use App\Repository\MenuRepository;
use App\Repository\BurgerRepository;
use App\DataProvider\ProduitCatalogueDataProvider;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;

final class ProduitCatalogueDataProvider implements ContextAwareCollectionDataProviderInterface,RestrictedDataProviderInterface{

    public function __construct(MenuRepository $menuRepo,BurgerRepository $burgerRepo){
        $this->menuRepo= $menuRepo;
        $this->burgerRepo= $burgerRepo;

        // dd($this->menuRepo->findAll());
    }

  
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []){

        
        // $context['menu'] = $this->menuRepo->findAll();
        // dd($context);
        $catalogue=[];
        $catalogue['burger'] = $this->burgerRepo->findAll();
        $catalogue['menu'] = $this->menuRepo->findAll();
        return $catalogue;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []):bool{


        return $resourceClass == ProduitCatalogueDataProvider:: class;
    }

}