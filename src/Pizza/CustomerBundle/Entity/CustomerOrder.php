<?php

namespace Pizza\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use NoahGlaser\EntityBundle\Entity\Base;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CustomerOrder
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pizza\CustomerBundle\Entity\CustomerOrderRepository")
 */
class CustomerOrder extends Base
{
    
    public function __construct() 
    {
        $this->orderitems = new ArrayCollection();
    }
    
    /**
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="customerorders")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    protected $customer;
    
    /**
     * @ORM\OneToMany(targetEntity="CustomerOrderItem", mappedBy="customerorder", cascade={"all"}))
     */
    protected $orderitems;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="ready", type="boolean")
     */
    protected $ready;


    /**
     * @var boolean
     *
     * @ORM\Column(name="received", type="boolean")
     */
    protected $received;

    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    public function getCustomer()
    {
        return $this->customer;
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
    
    public function setReady($ready)
    {
        $this->ready = $ready;
        return $this;
    }
    
    public function getReady()
    {
        return $this->ready;
    }
    
    public function setReceived($received)
    {
        $this->received = $received;
        return $this;
    }
    
    public function getReceived()
    {
        return $this->received;
    }
   
}
