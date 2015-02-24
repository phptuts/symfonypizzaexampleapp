<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Order
 *
 * @author student
 */
namespace Pizza\CustomerBundle\Mapper\Database;

use Doctrine\ORM\EntityManager;
use Pizza\CustomerBundle\DataTransferObjects\Customer as CustomerContract;
use Pizza\CustomerBundle\DataTransferObjects\Pizza;
use Pizza\CustomerBundle\Entity\Customer as CustomerDB;
use Pizza\CustomerBundle\Entity\CustomerOrder;
use Pizza\CustomerBundle\Entity\CustomerOrderSubItem;
use Pizza\CustomerBundle\Entity\ProductRepository;
use Pizza\CustomerBundle\Entity\CustomerOrderItem;

class Order 
{
    private $em;
    private $productrepo;
    private $products;
    
    public function __construct( ProductRepository $prodrepo) 
    {
        $this->productrepo = $prodrepo;
        $products = $this->productrepo->findAll();
        foreach($products as $product)
        {
            $this->products[$product->getId()] = $product;
        }
                
    }
    
    public function saveOrder(CustomerDB $customerdb, CustomerContract $customer)
    {
        $customerOrder = new CustomerOrder();
        $customerOrder->setReady(false);
        $customerOrder->setReceived(false);
        $customerOrder->setCustomer($customerdb);
        
        foreach($customer->getPizzas() as $pizza)
        {
            $item = new CustomerOrderItem();
            
            $item->setAmount($pizza->getAmount());
            $item->setProduct($this->products[$pizza->getType()]);
            foreach($pizza->getToppings() as $topping)
            {
                $subitem = new CustomerOrderSubItem();
                $subitem->setProduct($this->products[$topping]);
                $subitem->setItem($item);
                $item->addSubitem($subitem);
            }
            $item->setCustomerorder($customerOrder);
            $customerOrder->addOrderitems($item);
        }
        
        $customerdb->addCustomerorder($customerOrder);
        
        return $customerdb;
        
    }
    
}
