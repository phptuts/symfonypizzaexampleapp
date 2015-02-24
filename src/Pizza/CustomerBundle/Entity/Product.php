<?php

namespace Pizza\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use NoahGlaser\EntityBundle\Entity\Base;

/**
 * Product
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pizza\CustomerBundle\Entity\ProductRepository")
 */
class Product extends Base
{
    
    /**
     * @ORM\OneToMany(targetEntity="CustomerOrderSubItem", mappedBy="product")
     */
    protected $subitems;

    /**
     * @ORM\OneToMany(targetEntity="CustomerOrderItem", mappedBy="product")
     */
    protected $orderitems;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;
    

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;


    /**
     * Set name
     *
     * @param string $name
     * @return Product
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

    /**
     * Set description
     *
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }
    
    
    public function getSubitems()
    {
        return $this->subitems;
    }
    
    public function setSubitems($subitems)
    {
        foreach($subitems as $sub)
        {
            $this->addSubitem($sub);
        }
    }
    
    public function addSubitem($sub)
    {
        $this->subitems->add($sub);
    }
    
    public function removeSubitem($sub)
    {
        $this->subitems->removeElement($sub);
    }
    
    public function getOrderitems() 
    {
        return $this->orderitems;
    }

    public function setOrderitems($orderitems) 
    {
        foreach($orderitems as $item)
        {
            $this->addOrderitems($item);
        }
    }

    public function addOrderitems($item)
    {
        $this->orderitems->add($item);
    }
    
    public function removeOrderitems($item)
    {
        $this->orderitems->removeElement($item);
    }
    
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }
    
    public function getCategory()
    {
        return $this->category;
    }
}
