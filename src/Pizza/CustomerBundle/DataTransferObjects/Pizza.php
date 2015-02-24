<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pizza
 *
 * @author student
 */
namespace Pizza\CustomerBundle\DataTransferObjects;

use Symfony\Component\Validator\Constraints as Assert;


class Pizza 
{
    
    public function __construct() 
    {
        $this->toppings = array();
    }
    
    private $type;
    
    
    /**
     * @Assert\NotBlank(message="datatranserobject_customer_amount_notblank", groups={"addpizza"}) 
     * @Assert\Range(min=1, max=20, minMessage="datatranserobject_customer_amount_length", maxMessage="datatranserobject_customer_amount_length", groups={"addpizza"}) 
     */
    private $amount;
    /**
     * @Assert\Count(
     *      min = "0",
     *      max = "5",
     *      minMessage = "datatranserobject_customer_topping_count",
     *      maxMessage = "datatranserobject_customer_topping_count", 
     *      groups={"addpizza"}
     * )     
     */   
    private $toppings;
    
    function getType() 
    {
        return $this->type;
    }

    function getToppings() 
    {
        return $this->toppings;
    }

    function setType($type)
    {
        $this->type = $type;
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
    

    function getAmount() 
    {
        return $this->amount;
    }

    function setAmount($amount) 
    {
        $this->amount = $amount;
    }



    


    
}
