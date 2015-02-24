<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizza\CustomerBundle\Mapper\Database;

use Doctrine\ORM\EntityManager;
use Pizza\CustomerBundle\DataTransferObjects\Customer as CustomerDataTransfer;
use Pizza\CustomerBundle\DataTransferObjects\Pizza;
use Pizza\CustomerBundle\Entity\CustomerRepository;
use Pizza\CustomerBundle\Entity\Customer as CustomerDB;

class Customer 
{
    private $em;
    
    private $customerrepo;
    
    public function __construct(EntityManager $em,  CustomerRepository $customerreop) 
    {
        $this->em = $em;
        $this->customerrepo = $customerreop;
    }
    
    public function saveCustomer(CustomerDataTransfer $customer)
    {
        $customerdb = $this->customerrepo->findOneBy(array('phone' => $customer->getPhone(), 'lastname' => $customer->getLastname()));
        if($customerdb === null)
        {
            $customerdb = new CustomerDB();
            $customerdb->setPhone($customer->getPhone());
            $customerdb->setLastname($customer->getLastname());
            return $customerdb;
        }
        
        return $customerdb;
        
    }
}
