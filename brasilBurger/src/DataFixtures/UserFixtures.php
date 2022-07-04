<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $hashedPassword;

    public function __construct(UserPasswordHasherInterface $hashedPassword)
    {
        $this->hashedPassword = $hashedPassword;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('client@example.com');
        $hashedPassword = $this->hashedPassword->hashPassword($user,'passer');
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_CLIENT']);

        $user1= new User();
        $user1->setEmail('gestionnaire@example.com');
        $hashedPassword = $this->hashedPassword->hashPassword($user1,'passer');
        $user1->setPassword($hashedPassword);
        $user1->setRoles(['ROLE_GESTIONNAIRE']);

        $manager->persist($user);
        $manager->persist($user1);
        $manager->flush();

    }
}
