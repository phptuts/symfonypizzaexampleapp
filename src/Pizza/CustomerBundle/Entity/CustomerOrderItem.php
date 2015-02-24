<?php

namespace Pizza\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use NoahGlaser\EntityBundle\Entity\Base;

/**
 * CustomerOrderItem
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pizza\CustomerBundle\Entity\CustomerOrderItemRepository")
 */
class CustomerOrderItem extends Base
{   
    public function __construct() 
    {
        $this->subitems = new ArrayCollection();
    }
    
    /**
     * @ORM\ManyToOne(targetEntity="CustomerOrder", inversedBy="orderitems")
     * @ORM\JoinColumn(name="customerorder_id", referencedColumnName="id")
     */
    protected $customerorder;
    
    /**
     * @ORM\OneToMany(targetEntity="CustomerOrderSubItem", mappedBy="item", cascade={"all"}))
     */
    protected $subitems;
    
    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="orderitems")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product;
    
    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;


    public function getAmount()
    {
        return $this->amount;
    }
    
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }
    
    public function getProduct()
    {
        return $this->product;
    }
    
    public function setProduct($product)
    {
        $this->product = $product;
        return $this;
    }

    public function setCustomerorder($customerorder)
    {
        $this->customerorder = $customerorder;
        return $this;
    }
    
    public function getCustomerorder()
    {
        return $this->customerorder;
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
}
