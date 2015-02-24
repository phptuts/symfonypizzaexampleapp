<?php

namespace Pizza\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use NoahGlaser\EntityBundle\Entity\Base;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Customer
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pizza\CustomerBundle\Entity\CustomerRepository")
 */
class Customer extends Base
{
   
    public function __construct() 
    {
        $this->customerorders = new ArrayCollection();
    }
    
    /**
     * @ORM\OneToMany(targetEntity="CustomerOrder", mappedBy="customer", cascade={"all"})
     */
    protected $customerorders;
    

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=10)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;


    /**
     * Set phone
     *
     * @param string $phone
     * @return Customer
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }



    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Customer
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }
    
    public function getCustomerorders() 
    {
        return $this->customerorders;
    }

    public function setCustomerorders($customerorders) 
    {
        foreach($customerorders as $order)
        {
            $this->addCustomerorders($order);
        }
    }

    public function addCustomerorder($customerorder)
    {
        $this->customerorders->add($customerorder);
    }
    
    public function removeCustomerorders($customerorder)
    {
        $this->customerorders->removeElement($customerorder);
    }
    

    
}
