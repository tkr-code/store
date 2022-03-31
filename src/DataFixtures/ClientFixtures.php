<?php

namespace App\DataFixtures;

use App\Entity\Adresse;
use App\Entity\Client;
use App\Entity\User;
use App\Entity\Personne;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ClientFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct( UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->passwordEncoder = $userPasswordHasherInterface;
    }
    public function load(ObjectManager $manager)
    {
       $clients=
        [
            [

               'first_name' => 'PrenomClient','last_name' => 'NomClient',
               'email' => 'client@store.com','roles' => ["ROLE_CLIENT"],
               'password' => 'clientstore','is_verified' => true,'num'=>'1'
            ],
            [

               'first_name' => 'PreClient1','last_name' => 'NomClient1',
               'email' => 'client2@store.com','roles' => ["ROLE_CLIENT"],
               'password' => 'clientstore','is_verified' => false,'num'=>'2'
            ],
            
        ];
        foreach ($clients as $value) {
            $adresse = new Adresse();
            $adresse->setCountrycOde('Sn')
            ->setStreet('Sacre coeur 2')
            ->setCity('Dakar');
            $user = new User();
            $adresse->setFirstName($value['first_name'])
            ->setLastName($value['last_name']);
            $user->addAdress($adresse);
            $user->isVerified($value['is_verified']);
            $personne = new Personne();
            $personne->setFirstName($value['first_name'])
            ->setLastName($value['last_name']);
            $user->setEmail($value['email']);
            $user->setPassword($this->passwordEncoder->hashPassword($user,'password'))
            ->setRoles($value['roles'])
            ->setPersonne($personne);
            $client = new Client();
            $client->setUser($user);
            $this->addReference('_client'.$value['num'], $client);
            $manager->persist($client);
        }

        $manager->flush();
    }
}