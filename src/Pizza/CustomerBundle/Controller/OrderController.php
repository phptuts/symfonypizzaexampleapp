<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pizza\CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class OrderController extends Controller
{
    public function orderAction(Request $request)
    {
        $addorder = $this->createForm('addorder');
        
        if($request->getMethod() === "POST")
        {
            $addorder->handleRequest($request);
            if($addorder->isValid())
            {
                
                $customer = $this->get('pizza_customer.mapper.database.customer')->saveCustomer($addorder->getData());
                $customer = $this->get('pizza_customer.mapper.database.order')->saveOrder($customer, $addorder->getData());
                $this->getDoctrine()->getManager()->persist($customer);
                $this->getDoctrine()->getManager()->flush();
                $orderId = $this->getDoctrine()->getRepository('PizzaCustomerBundle:CustomerOrder')->getLatestestOrderId($customer);
                return $this->redirect($this->generateUrl('pizza_customer_show_order', array('orderId' => $orderId)));
            }
            
        }
        $view = array();
        $view['addorder'] = $addorder->createView();
                $view['page'] = 'order';

        return $this->render('PizzaCustomerBundle:Home:order.html.twig', $view);
    }
    
    public function showOrderAction(Request $request, $orderId)
    {
        $order = $this->getDoctrine()->getRepository('PizzaCustomerBundle:CustomerOrder')->find($orderId);
        $items = [];
        $ready = $order->getReady();
        $price = 0;
        foreach($order->getOrderitems() as $itemdb)
        {
            $item = [];
            $product = $itemdb->getProduct();
            $item['price'] = $product->getPrice();
            $price += $item['price'];
            $item['type'] = 'Pizza';
            $item['name'] = $product->getName();
            $items[] = $item;
            foreach($itemdb->getSubitems() as $subitemdb)
            {
                $subitem          = [];
                $subproduct       = $subitemdb->getProduct();
                $subitem['price'] = $subproduct->getPrice();
                $subitem['name']  = $subproduct->getName();
                $subitem['type']  = 'Topping';
                $items[]          = $subitem;
                $price           += $subitem['price'];

            }
        }
        
        $view = [];
        $view['orderId'] = $order->getId();
        $view['ready'] = $ready;
        $view['customerorder'] = $items;
        $view['total'] = $price;
        $view['page'] = 'order';
        
        return $this->render('PizzaCustomerBundle:Home:show.html.twig', $view);
    }
    
    public function homeAction(Request $request)
    {
        return $this->render('PizzaCustomerBundle:Home:home.html.twig', array('page' => 'home'));
    }
    
    public function changeLocalizationAction(Request $request, $_locale)
    {
        try
        {
             $request->setLocale($_locale);
             return new JsonResponse(array('success' => true));

        } 
        catch (\Exception $ex) 
        {
             return new JsonResponse(array('success' => false, 'message' => $ex->getMessage()));
        }
    }
    
}
