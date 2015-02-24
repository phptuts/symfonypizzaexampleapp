<?php

namespace Pizza\CustomerBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pizza\CustomerBundle\Entity\Category;


class LoadCategories extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $pizzaType = new Category();
        $pizzaType->setName('pizza');
        $manager->persist($pizzaType);
                
        $topping = new Category();
        $topping->setName('topping');
        $manager->persist($topping);
        $manager->flush();
        
                
        $this->addReference('cat-pizza-type', $pizzaType);
        $this->addReference('cat-topping-type', $topping);

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; 
    }
}