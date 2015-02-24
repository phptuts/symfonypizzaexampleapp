<?php

namespace Pizza\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use NoahGlaser\EntityBundle\Entity\Base;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pizza\CustomerBundle\Entity\CategoryRepository")
 */
class Category extends Base
{
    
    public function __construct() 
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category")
     */
    protected  $products;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    public function getProducts()
    {
        return $this->products;
    }
    
    public function setProducts($products)
    {
        foreach($products as $product)
        {
            $this->addProduct($product);
        }
    }
    
    public function addProduct($product)
    {
        $this->products->add($product);
    }
    
    public function remvoeProduct($product)
    {
        $this->products->removeElement($product);
    }
}
