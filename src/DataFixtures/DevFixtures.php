<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Client;
use App\Entity\Personne;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class DevFixtures extends Fixture
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
        // $user = new User();
        // $personne = new Personne();
        // $personne->setFirstName('client')
        // ->setLastName('Test');
        // $user->setEmail('clienttest@lest.sn');
        // $user->setStatus('Activer');
        // $user->setCle('123456');
        // $user->setPhoneNumber('770000000');
        // $user->setPassword($this->passwordEncoder->hashPassword($user,'password'))
        // ->setRoles(['ROLE_CLIENT'])
        // ->setPersonne($personne);
        // $client = new Client();
        // $client->setUser($user);
        // $user->setClient($client);
        // $this->addReference('client_test',$user);
        // $this->em->persist($user);

        // $manager->flush();
    }
}
