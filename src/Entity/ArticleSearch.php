<?php 
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class ArticleSearch{        
    /**
     * mots
     *
     * @var mixed
     */
    private $mots;
    /**
     * category
     *
     * @var mixed
     */
    private $category;

    private $category2;
    
    private $category3;
    /**
     * @Assert\Range(
     * min="100"
     * )
     */
    private $maxPrice;

        /**
     * @Assert\Range(
     * min="100"
     * )
     */
    private $minPrice;

    private $brand;

    private $etat;

    /**
     * Get the value of maxPrice
     * 
     */ 
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * Set the value of maxPrice
     * @return  self
     */ 
    public function setMaxPrice(int $maxPrice)
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    /**
     * Get min="100",
     */ 
    public function getMinPrice()
    {
        return $this->minPrice;
    }

    /**
     * Set min="100",
     *
     * @return  self
     */ 
    public function setMinPrice($minPrice)
    {
        $this->minPrice = $minPrice;

        return $this;
    }

    /**
     * Get the value of category
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the value of mots
     */ 
    public function getMots()
    {
        return $this->mots;
    }

    /**
     * Set the value of mots
     *
     * @return  self
     */ 
    public function setMots($mots)
    {
        $this->mots = $mots;

        return $this;
    }

    /**
     * Get the value of brand
     */ 
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set the value of brand
     *
     * @return  self
     */ 
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get the value of etat
     */ 
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set the value of etat
     *
     * @return  self
     */ 
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }
    /**
     * Get the value of category3
     */ 
    public function getCategory3()
    {
        return $this->category3;
    }

    /**
     * Set the value of category3
     *
     * @return  self
     */ 
    public function setCategory3($category3)
    {
        $this->category3 = $category3;

        return $this;
    }

    /**
     * Get the value of category2
     */ 
    public function getCategory2()
    {
        return $this->category2;
    }

    /**
     * Set the value of category2
     *
     * @return  self
     */ 
    public function setCategory2($category2)
    {
        $this->category2 = $category2;

        return $this;
    }
}