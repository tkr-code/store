<?php

namespace App\DataFixtures;

use App\Entity\Personne;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $em;
    private $passwordEncoder;
    public function __construct(EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->em = $entityManagerInterface;
        $this->passwordEncoder = $userPasswordHasherInterface;
    }
    public function load(ObjectManager $manager)
    {
        $users = array(
        array('first_name' => 'Malick','last_name' => 'Tounkara','email' => 'admin@store.com','roles' => ["ROLE_ADMIN","ROLE_EDITOR"],'is_verified' => true),
        array('first_name' => 'Mamadou','last_name' => 'Dieme','email' => 'editor@store.com','roles' => ["ROLE_EDITOR","ROLE_USER"],'is_verified' => true),
        );
        foreach ($users as $value) {
            $user = new User();
            $personne = new Personne();
            $personne->setFirstName($value['first_name'])
            ->setLastName($value['last_name']);
            $user->setEmail($value['email']);
            $user->isVerified(true);
            $user->setPassword($this->passwordEncoder->hashPassword($user,'password'))
            ->setRoles($value['roles'])
            ->setPersonne($personne);
            $this->em->persist($user);
        }
        $this->em->flush();
    }
}