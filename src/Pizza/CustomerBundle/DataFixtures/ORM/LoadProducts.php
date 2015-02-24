<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadProducts
 *
 * @author student
 */
namespace Pizza\CustomerBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pizza\CustomerBundle\Entity\Product;


class LoadProducts extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
       $chicagopizza = new Product();
       $chicagopizza->setName('Chicago style pizza');
       $chicagopizza->setPrice(10.88);
       $chicagopizza->setDescription('This is a pizza from chicago.  It\'s awesome');
       $chicagopizza->setCategory($this->getReference('cat-pizza-type'));
       $manager->persist($chicagopizza);
       
       $newyorkpizza = new Product();
       $newyorkpizza->setName('New York style pizza');
       $newyorkpizza->setPrice(13.88);
       $newyorkpizza->setDescription('This is a pizza from New York City.  It\'s awesome');
       $newyorkpizza->setCategory($this->getReference('cat-pizza-type'));
       $manager->persist($newyorkpizza);

       $calipizza = new Product();
       $calipizza->setName('California style pizza');
       $calipizza->setPrice(13.88);
       $calipizza->setDescription('This is a pizza from California.  It\'s awesome');
       $calipizza->setCategory($this->getReference('cat-pizza-type'));
       $manager->persist($calipizza);
       
       $pepperoni = new Product();
       $pepperoni->setName('pepperoni');
       $pepperoni->setPrice(.68);
       $pepperoni->setDescription('Fresh pepperoni');
       $pepperoni->setCategory($this->getReference('cat-topping-type'));
       $manager->persist($pepperoni);

       $cheese = new Product();
       $cheese->setName('extra cheese');
       $cheese->setPrice(.68);
       $cheese->setDescription('cheesy');
       $cheese->setCategory($this->getReference('cat-topping-type'));
       $manager->persist($cheese);

       $bacon = new Product();
       $bacon->setName('bacon');
       $bacon->setPrice(.98);
       $bacon->setDescription('I love bacon :)');
       $bacon->setCategory($this->getReference('cat-topping-type'));
       $manager->persist($bacon);
       
       $sausage = new Product();
       $sausage->setName('sausage');
       $sausage->setPrice(.98);
       $sausage->setDescription('(: sausage :)');
       $sausage->setCategory($this->getReference('cat-topping-type'));
       $manager->persist($sausage);
   
       $pineapple = new Product();
       $pineapple->setName('pineapple');
       $pineapple->setPrice(.38);
       $pineapple->setDescription('(: pineapple :)');
       $pineapple->setCategory($this->getReference('cat-topping-type'));
       $manager->persist($pineapple);
       
       $onions = new Product();
       $onions->setName('onions');
       $onions->setPrice(.38);
       $onions->setDescription('(: onions :)');
       $onions->setCategory($this->getReference('cat-topping-type'));
       $manager->persist($onions);

       $chicken = new Product();
       $chicken->setName('chicken');
       $chicken->setPrice(1.38);
       $chicken->setDescription('(: chicken :)');
       $chicken->setCategory($this->getReference('cat-topping-type'));
       $manager->persist($chicken);
       
       $ham = new Product();
       $ham->setName('ham');
       $ham->setPrice(1.38);
       $ham->setDescription('(: ham :)');
       $ham->setCategory($this->getReference('cat-topping-type'));
       $manager->persist($ham);
       
       $mushroom = new Product();
       $mushroom->setName('mushrooms');
       $mushroom->setPrice(1.38);
       $mushroom->setDescription('(: mushrooms :)');
       $mushroom->setCategory($this->getReference('cat-topping-type'));
       $manager->persist($mushroom);  
       
       $greenpepper = new Product();
       $greenpepper->setName('mushrooms');
       $greenpepper->setPrice(1.38);
       $greenpepper->setDescription('(: mushrooms :)');
       $greenpepper->setCategory($this->getReference('cat-topping-type'));
       $manager->persist($greenpepper);   
       
       $manager->flush();

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; 
    }
}
