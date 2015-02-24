<?php

namespace Pizza\CustomerBundle\Form\Datatransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\TaskBundle\Entity\Issue;

class LastNameTransformer implements DataTransformerInterface
{
   
    public function transform($lastname)
    {
        return ucfirst($lastname);

    }

    public function reverseTransform($lastname)
    {
        return strtolower($lastname);       
    }

}
