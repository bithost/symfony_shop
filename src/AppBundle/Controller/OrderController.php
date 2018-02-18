<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Orders;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class OrderController extends Controller
{
    /**
     * @Route("/order/create", name="create")
     */
    public function createAction(Request $request)
    {
        $order = new Orders;
        $form = $this->createFormBuilder($order)
            ->add('customerName', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('quantity', IntegerType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('totalPrice', IntegerType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('orderStatus', HiddenType::class, array('data' => 1))
            ->add('save', SubmitType::class, array('label' => 'Create New Order','attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
            ->getForm();

         $form->handleRequest($request);
         
         if($form->isSubmitted() && $form->isValid()){
            $order = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();

            $this->addFlash(
                'notice',
                'Order Created'
            );
            return $this->redirectToRoute('list_orders');
         }
         


        // replace this example code with whatever you need
        return $this->render('order/create.html.twig', array(
            'form' => $form->createView(),));
    }

        /**
     * @Route("/order/edit/{id}", name="edit")
     */
    public function editAction($id, Request $request)
    {
        $order = $this->getDoctrine()
        ->getRepository('AppBundle:Orders')
        ->find($id);

        $form = $this->createFormBuilder($order)
            ->add('customerName', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px','readonly' => true)))
            ->add('quantity', IntegerType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px','readonly' => true)))
            ->add('totalPrice', IntegerType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px','readonly' => true)))
            ->add('orderStatus', ChoiceType::class, array('choices'  => array('In Progress' => 1,'Sent' => 2,'Deliverred' => 3, 'Cancelled' => 4),'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('save', SubmitType::class, array('label' => 'Update Order','attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
            ->getForm();

         $form->handleRequest($request);
         
         if($form->isSubmitted() && $form->isValid()){
            $order = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();

            $this->addFlash(
                'notice',
                'Order Updated'
            );
            return $this->redirectToRoute('list_orders');
         }
   

        // replace this example code with whatever you need
      return $this->render('order/edit.html.twig', array(
            'order' =>$order,
            'form' => $form->createView(),
      ));
    }

    /**
     * @Route("/order/delete/{id}", name="delete")
     */
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('AppBundle:Orders')->find($id);

        $em->remove($order);
        $em->flush();

        $this->addFlash(
            'notice',
            'Order Removed'
        );

        return $this->redirectToRoute('list_orders');
    }
            /**
     * @Route("/order/list", name="list_orders")
     */
    public function listAction(Request $request)
    {
        $orders = $this->getDoctrine()
        ->getRepository('AppBundle:Orders')
        ->findAll();

        //$em = $this->getDoctrine()->getManager();
        //$dql   = "SELECT id FROM AppBundle:Item a";
        //$query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $orders, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
       

        // replace this example code with whatever you need
        return $this->render('order/list.html.twig',  array(
            'orders' => $pagination,));
    }
        /**
     * @Route("/order/view/{id}", name="view")
     */
    public function viewAction($id, Request $request)
    {
        $order = $this->getDoctrine()
        ->getRepository('AppBundle:Orders')
        ->find($id);
        // replace this example code with whatever you need
        return $this->render('order/view.html.twig', array(
            'order' => $order
        ));
    }
}
