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
     * @Route("/order/create/{id}", name="create")
     */
    public function createAction($id, Request $request)
    {
        $order = new Orders;
        $form = $this->createFormBuilder($order)
            ->add('customerName', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('quantity', IntegerType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('totalPrice', IntegerType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('orderStatus', HiddenType::class, array('data' => 1))
            ->add('save', SubmitType::class, array('label' => 'Create New Item','attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
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
        // replace this example code with whatever you need
        return $this->render('order/edit.html.twig', [
        ]);
    }

    /**
     * @Route("/order/delete/{id}", name="delete")
     */
    public function deleteAction($id, Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('order/delete.html.twig', [
        ]);
    }
            /**
     * @Route("/order/list", name="list_orders")
     */
    public function listAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('order/list.html.twig', [
        ]);
    }
        /**
     * @Route("/order/view", name="view")
     */
    public function viewAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('order/view.html.twig', [
        ]);
    }

}
