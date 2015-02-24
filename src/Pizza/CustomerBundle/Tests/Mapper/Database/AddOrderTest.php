<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AddOrderTest
 *
 * @author student
 */
namespace Pizza\CustomerBundle\Tests\Mapper\Database;

use Pizza\CustomerBundle\DataTransferObjects\Customer;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bridge\Doctrine\DataFixtures\ContainerAwareLoader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;

class AddOrderTest extends WebTestCase
{
    protected static $container;
    
    protected static $em;
    
    private $pizzatypes;
    
    private $toppings;


    public static function setUpBeforeClass()
    {
         //start the symfony kernel
         $kernel = static::createKernel();
         $kernel->boot();

         //get the DI container
         self::$container = $kernel->getContainer();
         
         self::$em = $kernel->getContainer()->get('doctrine.orm.default_entity_manager');

         //now we can instantiate our service (if you want a fresh one for
         //each test method, do this in setUp() instead
    }
    
    public function setUp() 
    {
        $loader = new ContainerAwareLoader(self::$container);
        $loader->loadFromDirectory('./src/Pizza/CustomerBundle/DataFixtures/ORM');
        $purger = new ORMPurger(self::$em);
        $executor = new ORMExecutor(self::$em, $purger);
        $executor->execute($loader->getFixtures());
        
        $categoryrepo = self::$em->getRepository('PizzaCustomerBundle:Category');
        $pizzaProducts = $categoryrepo->findOneBy(array('name' => 'pizza'));

        $toppingProduct = $categoryrepo->findOneBy(array('name' => 'topping'));
        
        foreach($pizzaProducts->getProducts() as $product)
        {
            $this->pizzatypes[] = $product;
        }
        
        foreach($toppingProduct->getProducts() as $product)
        {
            $this->toppings[] = $product;
        }

    }
    
    private function createCustomer()
    {
        $customeruser = new Customer();
        $customeruser->setLastname('Moololl');
        $customeruser->setPhone('3333332222');
        
        $pizza = new \Pizza\CustomerBundle\DataTransferObjects\Pizza();
        $pizza->setAmount(2);
        $pizzaid = $this->pizzatypes[1]->getId();
        $pizza->setType($pizzaid);
        $pizza->addTopping($this->toppings[2]->getId()) ;
        $pizza->addTopping($this->toppings[3]->getId()) ;
        $pizza->addTopping($this->toppings[4]->getId()) ;
        $customeruser->addPizza($pizza);
        return $customeruser;

    }
    
    public function testCreateCustomer()
    {
        $customeruser = $this->createCustomer();
        
        $DataTransfer = self::$container->get('pizza_customer.mapper.database.customer');
        $customer = $DataTransfer->saveCustomer($customeruser);
        
        $this->assertEquals($customeruser->getLastname(), $customer->getLastname());
        $this->assertEquals($customeruser->getPhone(), $customer->getPhone());

    }
    
    public function testCreateOrder()
    {
        $customercontract = $this->createCustomer();
        $customerTransformer = self::$container->get('pizza_customer.mapper.database.customer');
        $orderTransformer = self::$container->get('pizza_customer.mapper.database.order');
        $customerdb = $customerTransformer->saveCustomer($customercontract);
        $customerdbfinal = $orderTransformer->saveOrder($customerdb, $customercontract);
        $pizzacount = $customerdbfinal->getCustomerorders()->first()->getOrderitems()->count();
        $pizzaProductId = $customerdbfinal->getCustomerorders()->first()->getOrderitems()->first()->getProduct()->getId();
        $pizzaDB = $customerdbfinal->getCustomerorders()->first()->getOrderitems()->first();
        
        $pizzas = $customercontract->getPizzas();
        
        $toppings = [];
        foreach($pizzaDB->getSubitems() as $topping)
        {
           $toppings[]  = $topping->getProduct()->getId();
        }
        $this->assertEquals($pizzacount, 1);
        $this->assertEquals($pizzas[0]->getType(), $pizzaProductId);
        $this->assertEquals(count($customercontract->getPizzas()[0]->getToppings()), $pizzaDB->getSubitems()->count());
        $this->assertTrue(in_array($customercontract->getPizzas()[0]->getToppings()[0], $toppings));
        $this->assertTrue(in_array($customercontract->getPizzas()[0]->getToppings()[1], $toppings));

    }
    
}
