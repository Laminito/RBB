<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailerController extends AbstractController
{
   public function __invoke(Request $request,EntityManagerInterface $emi,UserRepository $userepo){
        $token = $request->get("generateToken");
        $user= $userepo->findOneBy(["generateToken"=>$token]);

        if(!$user){
            return new JsonResponse(["error"=>"Invalide"],400);
        }
        if($user->isIsActivate()){
            return new JsonResponse(["error"=>"It is activated"]);
        }
        if($user->getExpirate()< new \DateTime() ){
            return new JsonResponse(["error"=>"Token expired"]);
        }

        $user->setIsActivate(true);
        $emi->persist($user);
        $emi->flush();
        return new JsonResponse(["succes"=>"You account is activated",200]);

   }
}