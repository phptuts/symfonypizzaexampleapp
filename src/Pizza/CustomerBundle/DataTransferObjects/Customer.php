<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Customer
 *
 * @author student
 */
namespace Pizza\CustomerBundle\DataTransferObjects;

use Symfony\Component\Validator\Constraints as Assert;


class Customer 
{
    public function __construct() 
    {
        $this->pizzas = array();
    }
    
    /**
     * @Assert\NotBlank(message="datatranserobject_customer_phone_notblank", groups={"addpizza"}) 
     * @Assert\Length(min=4, max=20, minMessage="datatranserobject_customer_phone_length", maxMessage="datatranserobject_customer_phone_length", groups={"addpizza"}) 
     */
    private $phone;

    /**
     * @Assert\NotBlank(message="datatranserobject_customer_lastname_notblank", groups={"addpizza"}) 
     * @Assert\Length(min=3, max=50, minMessage="datatranserobject_customer_lastname_length", maxMessage="datatranserobject_customer_lastname_length", groups={"addpizza"}) 
     */
    private $lastname;
    
    /**
     * @Assert\Count(
     *      min = "1",
     *      max = "20",
     *      minMessage = "datatranserobject_customer_pizzas_count",
     *      maxMessage = "datatranserobject_customer_pizzas_count",
     *      groups={"addpizza"}
     * )     
     */
    private $pizzas;
    
    function getPhone() 
    {
        return $this->phone;
    }

    function getLastname()
    {
        return $this->lastname;
    }

    function getPizzas() 
    {
        return $this->pizzas;
    }

    function setPhone($phone)
    {
        $this->phone = $phone;
    }

    function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    function setPizzas($pizzas)
    {
        foreach($pizzas as $pizza)
        {
            $this->addPizza($pizza);
        }
    }
    
    function addPizza($pizza)
    {
        $this->pizzas[] = $pizza;
    }


}
