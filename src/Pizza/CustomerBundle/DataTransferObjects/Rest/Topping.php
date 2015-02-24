<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Pizza\CustomerBundle\DataTransferObjects\Rest;

use JMS\Serializer\Annotation as JMS;


class Topping 
{
    
    /**
     * @JMS\Until("1")
     * @JMS\Groups({ "orders", "single_order"}) 
     * @JMS\Type("string")
     */
    private $name;
    
    
    /**
     * @JMS\Until("1")
     * @JMS\Groups({ "orders", "single_order"}) 
     * @JMS\Type("float")
     */    
    private $price;
    
    
    /**
     * @JMS\Until("1")
     * @JMS\Groups({ "orders", "single_order"}) 
     * @JMS\Type("string")
     */ 
    private $description;
    
    function getName() 
    {
        return $this->name;
    }

    function getPrice()
    {
        return $this->price;
    }

    function getDescription()
    {
        return $this->description;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function setPrice($price) 
    {
        $this->price = $price;
    }

    function setDescription($description)
    {
        $this->description = $description;
    }


}
