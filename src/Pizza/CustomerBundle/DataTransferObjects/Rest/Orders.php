<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Pizza\CustomerBundle\DataTransferObjects\Rest;

use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as JMS;

/**
 * 
 * @Hateoas\Relation(
 *      "self", 
 *      exclusion = @Hateoas\Exclusion(groups={"orders"}),
 *       href = @Hateoas\Route(
 *         "api_simpleget_order",
 *          parameters = { "orderId" = "expr(object.getOrderId())" }
 *      )
 * )
 * 
 * @Hateoas\Relation(
 *      "all", 
 *      exclusion = @Hateoas\Exclusion(groups={"single_order"}),
 *       href = @Hateoas\Route(
 *         "api_simpleget_orders"
 *      )
 * ) 
 */

class Orders
{
    
    public function __construct() 
    {
        $this->pizzas = array();
    }
     
    /**
     * @JMS\Until("1")
     * @JMS\Groups({ "orders", "single_order"}) 
     * @JMS\Type("string")
     */
    private $lastname;    
    
    /**
     * @JMS\Until("1")
     * @JMS\Groups({ "orders", "single_order"}) 
     * @JMS\Type("integer")
     */
    private $orderId;
    
    
    /**
     * @JMS\Until("1")
     * @JMS\Groups({ "orders", "single_order"}) 
     * @JMS\Type("array<Pizza\CustomerBundle\DataTransferObjects\Rest\Pizza>")
     */
    private $pizzas;
    
    /**
     * @JMS\Until("1")
     * @JMS\Groups({ "orders", "single_order"}) 
     * @JMS\Type("boolean")
     */
    private $isReady;
    
    function getOrderId() 
    {
        return $this->orderId;
    }

    function getPizzas()
    {
        return $this->pizzas;
    }

    function getIsReady()
    {
        return $this->isReady;
    }

    function setOrderId($orderId)
    {
        $this->orderId = $orderId;
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

    function setIsReady($isReady) 
    {
        $this->isReady = $isReady;
    }

    function getLastname() 
    {
        return $this->lastname;
    }

    function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }


}
