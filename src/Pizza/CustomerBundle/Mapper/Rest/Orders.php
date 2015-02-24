<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Orders
 *
 * @author student
 */
namespace Pizza\CustomerBundle\Mapper\Rest;

use Pizza\CustomerBundle\DataTransferObjects\Rest\Orders as RestOrder;
use Pizza\CustomerBundle\DataTransferObjects\Rest\Pizza;
use Pizza\CustomerBundle\DataTransferObjects\Rest\Topping;
use Pizza\CustomerBundle\Entity\CustomerOrderRepository;
use Pizza\CustomerBundle\Entity\CustomerOrder;

class Orders 
{
    private $orders;
    
    public function __construct(CustomerOrderRepository $orderrepo)
    {
        $this->orderrepo = $orderrepo;
    }
    
    public function getAllOrders()
    {
        $restorders = [];
        $orders = $this->orderrepo->findBy(array(), array('createdAt' => 'DESC') );
        foreach($orders as $order)
        {
            $restorders[] = $this->populateSingleOrder($order);
        }
        
        return $restorders;
    }
    
    public function getSingleOrder($id)
    {
        $order = $this->orderrepo->find($id);
        return $this->populateSingleOrder($order);
    }
    
    
    
    public function populateSingleOrder(CustomerOrder $customerorder)
    {
        $order = new RestOrder();
        $order->setIsReady($customerorder->getReady());
        $order->setOrderId($customerorder->getId());
        $order->setLastname($customerorder->getCustomer()->getLastname());
        
        foreach($customerorder->getOrderitems() as $item)
        {
            $pizza = new Pizza();
            $product = $item->getProduct();
            $pizza->setName($product->getName());
            $pizza->setDescription($product->getDescription());
            $pizza->setPrice($product->getPrice());
            foreach($item->getSubitems() as $subitems)
            {
                $topping = new Topping();
                $subproduct = $subitems->getProduct();
                $topping->setDescription($subproduct->getDescription());
                $topping->setName($subproduct->getName());
                $topping->setPrice($subproduct->getPrice());
                $pizza->addTopping($topping);
            }
            $order->addPizza($pizza);
        }
            
        return $order;
    }
}
