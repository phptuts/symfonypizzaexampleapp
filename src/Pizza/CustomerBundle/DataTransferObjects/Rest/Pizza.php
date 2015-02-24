<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Pizza\CustomerBundle\DataTransferObjects\Rest;

use JMS\Serializer\Annotation as JMS;


class Pizza
{
    
    public function __construct()
    {
        $this->toppings = array();
    }
    
    /**
     * @JMS\Until("1")
     * @JMS\Groups({ "orders", "single_order"}) 
     * @JMS\Type("string")
     */
    private $name;
    
    /**
     * @JMS\Until("1")
     * @JMS\Groups({ "orders", "single_order"}) 
     * @JMS\Type("string")
     */
    private $description;

    /**
     * @JMS\Until("1")
     * @JMS\Groups({ "orders", "single_order"}) 
     * @JMS\Type("float")
     */    
    private $price;
    
    /**
     * @JMS\Until("1")
     * @JMS\Groups({ "orders", "single_order"}) 
     * @JMS\Type("array<Pizza\CustomerBundle\DataTransferObjects\Rest\Topping>")
     */
    private $toppings;
    
    
    function getName() 
    {
        return $this->name;
    }

    function getDescription()
    {
        return $this->description;
    }

    function getPrice()
    {
        return $this->price;
    }

    function getToppings() 
    {
        return $this->toppings;
    }

    function setName($name) 
    {
        $this->name = $name;
    }

    function setDescription($description)
    {
        $this->description = $description;
    }

    function setPrice($price)
    {
        $this->price = $price;
    }

    function setToppings($toppings)
    {
        foreach($toppings as $topping)
        {
            $this->addTopping($topping);
        }
    }
    
    function addTopping($topping)
    {
        $this->toppings[] = $topping;
    }


    
}
