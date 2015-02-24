<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrderRestController
 *
 * @author student
 */
namespace Pizza\CustomerBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as FOS;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;


class OrderRestController extends FOSRestController
{
    /**
     * Gets a list of order
     * @FOS\View(
     *  serializerGroups={"orders"},
     * )
     * @ApiDoc(output={
     *           "class"   = "Pizza\CustomerBundle\DataTransferObjects\Rest\Orders",
     *           "parsers" = {
     *               "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *           },
     *           "groups" = {"orders"}
     *       })      
     */    
    public function getOrdersAction(Request $request)
    {
        return $this->get('pizza_customer.mapper.rest.order')->getAllOrders();
    }
    
    /**
     * Gets a single order
     * @FOS\View(
     *  serializerGroups={"single_order"},
     * )
     * @ApiDoc(output={
     *           "class"   = "Pizza\CustomerBundle\DataTransferObjects\Rest\Orders",
     *           "parsers" = {
     *               "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *           },
     *           "groups" = {"single_order"}
     *       })      
     */
    public function getOrderAction(Request $request, $orderId)
    {
        return $this->get('pizza_customer.mapper.rest.order')->getSingleOrder($orderId);
    }
}
