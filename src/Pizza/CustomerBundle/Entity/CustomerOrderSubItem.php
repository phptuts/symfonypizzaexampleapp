<?php

namespace Pizza\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use NoahGlaser\EntityBundle\Entity\Base;

/**
 * CustomerOrderSubItem
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pizza\CustomerBundle\Entity\CustomerOrderSubItemRepository")
 */
class CustomerOrderSubItem extends Base
{
    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="subitems")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product;
    
    /**
     * @ORM\ManyToOne(targetEntity="CustomerOrderItem", inversedBy="subitems")
     * @ORM\JoinColumn(name="customerorderitem_id", referencedColumnName="id")
     */
    protected $item;


    public function getProduct()
    {
        return $this->product;
    }
    
    public function setProduct($product)
    {
        $this->product = $product;
        return $this;
    }
    
    public function setItem($item)
    {
        $this->item = $item;
        return $this;
    }
    
    public function getItem()
    {
        return $this->item;
    }
}
