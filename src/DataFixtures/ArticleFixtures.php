<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\ArticleOption;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    private $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function load(ObjectManager $manager)
    {
        $articles = [
            [
                'title' => 'Hp probook','price' => '150000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '120000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Clavier sans fil','price' => '6000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '10000','cat'=>'Accessoires'
            ],
            [
                'title' => 'Chargeur Pc 15','price' => '10000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '5000','cat'=>'Accessoires'
            ],
            [
                'title' => 'Ecouteur Iphone','price' => '2500','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '1500','cat'=>'Accessoires'
            ],
            [
                'title' => 'Cle USB 32 go','price' => '5000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '2500','cat'=>'Accessoires'
            ],
            [
                'title' => 'Cle USB 8 go','price' => '3500','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '2500','cat'=>'Accessoires'
            ],
            [
                'title' => 'Cle USB 4 go','price' => '3000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '2500','cat'=>'Accessoires'
            ],
            [
                'title' => 'Cle USB 2 go','price' => '2000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '2500','cat'=>'Accessoires'
            ],
            [
                'title' => 'Ecouteur','price' => '1500','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '1000','cat'=>'Accessoires'
            ],
            
            [
                'title' => 'Galaxy S6 edge','price' => '130000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Accessoires'
            ],
            [
                'title' => 'Galaxy S6 edge','price' => '130000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Smartphone'
            ],
            [
                'title' => 'Galaxy S6 edge','price' => '130000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Smartphone'
            ],
            [
                'title' => 'Galaxy S6 edge','price' => '130000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Smartphone'
            ],
            [
                'title' => 'Galaxy S6 edge','price' => '130000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Smartphone'
            ],
            [
                'title' => 'Galaxy S6 edge','price' => '130000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Smartphone'
            ],
            [
                'title' => 'Galaxy S6 edge','price' => '130000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Smartphone'
            ],
            [
                'title' => 'Iphone 8','price' => '70000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '60000','cat'=>'Smartphone'
            ],
            [
                'title' => 'Iphone 6','price' => '70000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '60000','cat'=>'Smartphone'
            ],
            [
                'title' => 'Iphone 9','price' => '70000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '60000','cat'=>'Smartphone'
            ],
            [
                'title' => 'Chargeur Iphone','price' => '2000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '1000','cat'=>'Smartphone'
            ],
            [
                'title' => 'Iphone 12 pro','price' => '500000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '400000','cat'=>'Smartphone'
            ],
            [
                'title' => 'Cable HDMI 1,5m','price' => '130000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Smartphone'
            ],
            [
                'title' => 'Galaxy S6','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Smartphone'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Mini pc','price' => '90000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '80000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Hp elitebook 2170p','price' => '160000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '150000','cat'=>'Ordinateur'
            ],
            [
                'title' => 'Chemise manche courte','price' => '6000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '3000','cat'=>'Mode homme'
            ],
            [
                'title' => 'Veste Homme','price' => '120000','description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, aliquam est quidem enim, atque id eligendi qui voluptas provident deserunt consequuntur suscipit. In nesciunt illum doloremque repudiandae velit fugiat harum?',
                'buying_price' => '100000','cat'=>'Mode homme'
            ],
        ];

            foreach ($articles  as $cle => $value) {
                $cle += 1;
                $article  = new Article();
                $article->setTitle($value['title'])
                ->setRef('AR_'.rand(0,200))
                ->setCategory($this->getReference('cat_'.$value['cat']))
                ->setBuyingPrice($value['buying_price'])
                ->setPrice($value['price'])
                ->setEnabled(true)
                ->setIsExpiry(false)->setQuantityMin(3)
                ->setDescription($value['description'])
                ->setQuantity(10);
                $articleOption  = new ArticleOption();
                $articleOption->setTitle('Ecran')->setContent('12 pouces')->setCreatedAt(new \DateTime());
                $article->addOption($articleOption);
                $this->addReference('_article'.$cle, $article);
                $manager->persist($article);
            }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}