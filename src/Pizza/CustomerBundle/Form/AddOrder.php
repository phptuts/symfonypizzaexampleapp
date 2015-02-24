<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AddOrder
 *
 * @author student
 */
namespace Pizza\CustomerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Pizza\CustomerBundle\Form\Datatransformer\LastNameTransformer;
use Pizza\CustomerBundle\Form\Datatransformer\PhoneTransformer;

class AddOrder extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add($builder->create('phone')->addModelTransformer(new PhoneTransformer()));
        $builder->add($builder->create('lastname')->addModelTransformer(new LastNameTransformer()));
        $builder->add('pizzas', 'collection', array(
            'type'               => 'pizza',
            'by_reference'       => false,
            'allow_add'          => true,
            'allow_delete'       => true,
            'error_bubbling'     => false,
            'cascade_validation' => true,
            'prototype_name'     => 'pizza_replace__'
        ));
        
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
        return $resolver->setDefaults(
                    array(
                       'data_class' => 'Pizza\CustomerBundle\DataTransferObjects\Customer',
                       'validation_groups' => array('addpizza'),
                       'cascade_validation' => true
                    ));
    }
    
    public function getName() 
    {
        return 'addorder';
    }

}
