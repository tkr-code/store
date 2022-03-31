<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Payment;
use App\Service\Order\OrderService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends Fixture implements DependentFixtureInterface
{
    private $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function load(ObjectManager $manager)
    {
        $total = 0;
        $client  = $this->getReference('_client1');
        $orderItem = new OrderItem();
        $article = $this->getReference('_article1');
        $order = new Order();
        $order
            ->setNumber($this->orderService->voiceNumber())
            ->setNote('Note de test')
            ->setState('in progress')
            ->setPaymentState('in progress')
            ->setShippingState('in progress')
            ->setCheckoutState('in progress')
            ->setShipping(1500)
            ->setPaymentDue(new \DateTime('+ 6 day'));
            $user = $client->getUser();
            $adresses = $user->getAdresses();
            $order
            ->setShippingAdress($adresses[0])
            ->setUser($user)
            ;
        // Ligne de commande
        $orderItem->setProduitName($article->getTitle());
        $orderItem->setQuantity(3);
        $orderItem->setUnitPrice($article->getPrice());
        $orderItem->setUnitsTotal($orderItem->getUnitPrice() * $orderItem->getQuantity());
        $orderItem->setTotal($orderItem->getUnitsTotal() + $orderItem->getAdjustmentsTotal() );
        $total += $orderItem->getTotal();
        $orderItem->setArticle($article);
        $order->addOrderItem($orderItem);

        $order->setItemsTotal($total);
        $order->setAdjustmentsTotal($order->getShipping());
        $order->setTotal($order->getItemsTotal() + $order->getAdjustmentsTotal() );

        //Payment
        $payment = new Payment();
        $payment->setAmount($order->getTotal());
        $payment->setState('in progress');
        $method = $this->getReference('_paymentMethod1');
        $payment->setPaymentMethod($method);
        $order->setPayment($payment);
        
        $manager->persist($order);
        $manager->flush();
    }
    public function getDependencies()
    {
        return[
            PaymentMethodFixtures::class,
            ArticleFixtures::class,
            ClientFixtures::class
        ];
    }
}
