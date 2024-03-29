<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Category2Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=Category2Repository::class)
 */
class Category2
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=Category::class, mappedBy="category2")
     */
    private $categorys;

    /**
     * @ORM\ManyToOne(targetEntity=Category3::class, inversedBy="categorys2")
     */
    private $category3;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_active;



    public function __construct()
    {
        $this->categorys = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function getSlug()
    {   
        return $this->slug;
    }
    
    public function setSlug(): self
    {
        $Slugify = new Slugify();
        $slug  = $Slugify->slugify($this->getTitle());

        $this->slug = $slug;

        return $this;
    }
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategorys(): Collection
    {
        return $this->categorys;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categorys->contains($category)) {
            $this->categorys[] = $category;
            $category->setCategory2($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categorys->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getCategory2() === $this) {
                $category->setCategory2(null);
            }
        }

        return $this;
    }

    public function getCategory3(): ?Category3
    {
        return $this->category3;
    }

    public function setCategory3(?Category3 $category3): self
    {
        $this->category3 = $category3;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

}
