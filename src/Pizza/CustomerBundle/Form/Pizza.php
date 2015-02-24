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
namespace Pizza\CustomerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Pizza\CustomerBundle\Entity\CategoryRepository;
use Pizza\CustomerBundle\Entity\Category;

class Pizza extends AbstractType
{
    private $pizzaTypes;
    private $toppings;
    
    public function __construct(CategoryRepository $categoryrepo) 
    {
        $categoryPizza =  $categoryrepo->findOneBy(array('name' => 'pizza'));;
        $categoryTopping =  $categoryrepo->findOneBy(array('name' => 'topping'));
        $this->pizzaTypes = $categoryPizza->getProducts();
        $this->toppings = $categoryTopping->getProducts();
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $pizzaChoices = [];
        foreach($this->pizzaTypes as $pizza)
        {
            $pizzaChoices[$pizza->getId()] = $pizza->getName();
        }
        
        $toppingChoice = [];
        foreach($this->toppings as $topping)
        {
            $toppingChoice[$topping->getId()] = $topping->getName();
        }
        
        $builder->add('type', 'choice', array(
            'choices'   => $pizzaChoices,
            'expanded'  => false,
            'multiple'  => false
        ));
        
        $builder->add('toppings', 'choice', array(
            'choices'   => $toppingChoice,
            'expanded'  => true,
            'multiple'  => true
        ));
        
        $builder->add('amount');
    }
    
    public function buildView(FormView $view, FormInterface $form, array $options) 
    {
         
      
        foreach($this->pizzaTypes as $product)
        {
            $id = $product->getId();
            $view->vars['pizza'][$id]['description'] = $product->getDescription();
            $view->vars['pizza'][$id]['price'] = $product->getPrice();
            $view->vars['pizza'][$id]['id'] = $product->getId();

        }
        
        foreach($this->toppings as $topping)
        {
            $id = $topping->getId();
            $view->vars['topping'][$id]['description'] = $topping->getDescription();
            $view->vars['topping'][$id]['price'] = $topping->getPrice();


        }
        
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        return $resolver->setDefaults(array(
            'data_class' => 'Pizza\CustomerBundle\DataTransferObjects\Pizza',
            'validation_groups' => array('addpizza'),
            'cascade_validation' => true
        ));
    }
    
    public function getName() 
    {
        return 'pizza';
    }
}
