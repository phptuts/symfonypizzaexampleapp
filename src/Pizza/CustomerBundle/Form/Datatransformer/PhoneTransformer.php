<?php

namespace Pizza\CustomerBundle\Form\Datatransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\TaskBundle\Entity\Issue;

class PhoneTransformer implements DataTransformerInterface
{

    
    public function transform($phonenumber)
    {
        if( preg_match( '/^\+\d(\d{3})(\d{3})(\d{4})$/', $phonenumber,  $matches ) )
        {
            $result = $matches[1] . '-' .$matches[2] . '-' . $matches[3];
            return $result;
        }     
        
        return $phonenumber;
    }

        
    public function reverseTransform($phonenumber)
    {
        if (!$phonenumber) 
        {
            return null;
        }

        $phonenumber = str_replace(" ", "", $phonenumber);
        $phonenumber = str_replace("-", "", $phonenumber);
        $phonenumber = str_replace("(", "", $phonenumber);
        $phonenumber = str_replace(")", "", $phonenumber);
        

        return $phonenumber;
    }


    
    
}
