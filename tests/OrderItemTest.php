<?php

namespace App\Tests;

use App\Entity\Article;
use App\Entity\OrderItem;
use PHPUnit\Framework\TestCase;

class OrderItemTest extends TestCase
{
    public function testSomething(): void
    {
        $article = new Article();
        $article
            ->setTitle('Article 1')
            ->setPrice(120000)
            ->setDescription('Article description')
            ->setQuantity(5)->setQuantityMin(3)->setIsExpiry(false)
            ->setEnabled(true)->setBuyingPrice(100000)
            ->setRef('Ref_1');
        $orderItem = new OrderItem();
        $orderItem->setArticle($article);
        dump($orderItem);
        $this->assertTrue(true);
    }
}
