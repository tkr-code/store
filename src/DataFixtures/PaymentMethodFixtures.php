<?php

namespace App\DataFixtures;

use App\Entity\PaymentMethod;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PaymentMethodFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $payment_methods = array(
        array('id' => '1','name' => 'Orange Money','description' => 's sifteo edmodo ifttt zimbra','instructions' => 'ovity jajah plickers sifteo edmodo ifttt zimbra.'),
        array('id' => '2','name' => 'Wave','description' => 't zimbra.','instructions' => 'lickers sifteo edmodo ifttt zimbra.'),
        array('id' => '3','name' => 'Payement à la livraison','description' => 'Etsy doostttt zimbra.','instructions' => 'imbra.')
        );
        foreach ($payment_methods as $cle => $value) {
            $cle += 1;
            $paymentMethod = new PaymentMethod();
            $paymentMethod->setName($value['name'])
            ->setDescription($value['description'])
            ->setInstructions($value['instructions']); 
            $this->addReference('_paymentMethod'.$cle,$paymentMethod);
            $manager->persist($paymentMethod);
        }
        $manager->flush();
    }
}