<?php

namespace App\Controller;

use App\Entity\Burger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use ApiPlatform\Core\Filter\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class BurgerController extends AbstractController
{
    // #[Route('/burger', name: 'app_burger')]
  
    // public function __invoke(Request $request,
    // ValidatorInterface $validator,
    // TokenStorageInterface $tokenStorage,
    // SerializerInterface $serializer,
    // EntityManagerInterface $entityManager): JsonResponse
    // {

    //     $burger = $serializer->deserialize($request->getContent(),
    //     Burger::class,'json');
    //     $errors = $validator->validate($burger);
    //     if (count($errors) > 0) {
    //         $errorsString =$serializer->serialize($errors,"json");
    //         return new JsonResponse( $errorsString,Response::HTTP_BAD_REQUEST,[],true);
    //     }
    //     $burger->setGestionnaire($tokenStorage->getToken()->getUser());
    //     $entityManager->persist($burger);
    //     $entityManager->flush();
    //     $result =$serializer->serialize([
    //         'code'=>Response::HTTP_CREATED,
    //         'data'=>$burger
    //         ],
    //         "json",
    //         ["groups"=>["Burger:read:all"]
    //     ]);
    //     return new JsonResponse($result ,Response::HTTP_CREATED,[],true);
    // }

    
}
