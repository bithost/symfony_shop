<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Item;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ItemController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $items = $this->getDoctrine()
            ->getRepository('AppBundle:Item')
            ->findAll();
        // replace this example code with whatever you need
        return $this->render('item/index.html.twig', array(
            'items' => $items
        ));
    }
    /**
     * @Route("/item/create", name="new_item")
     */
    public function createAction(Request $request)
    {
        $item = new Item;
        $form = $this->createFormBuilder($item)
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('price', IntegerType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('available', ChoiceType::class, array('choices'  => array('Yes' => 1,'No' => 0 ),'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('save', SubmitType::class, array('label' => 'Create New Item','attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
            ->getForm();

         $form->handleRequest($request);
         
         if($form->isSubmitted() && $form->isValid()){
            $item = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            $this->addFlash(
                'notice',
                'Item Created'
            );
            return $this->redirectToRoute('view_items');
         }
         
        // replace this example code with whatever you need
        return $this->render('item/create.html.twig', array(
            'form' => $form->createView(),));
    }

    /**
     * @Route("/item/delete/{id}", name="delete_item")
     */
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository('AppBundle:Item')->find($id);

        $em->remove($item);
        $em->flush();

        $this->addFlash(
            'notice',
            'Item Removed'
        );

        return $this->redirectToRoute('view_items');
    }

        /**
     * @Route("/item/list", name="view_items")
     */
    public function listAction(Request $request)
    {
        $items = $this->getDoctrine()
        ->getRepository('AppBundle:Item')
        ->findAll();

        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT id FROM AppBundle:Item a";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $items, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
       

        // replace this example code with whatever you need
        return $this->render('item/list.html.twig', array(
            'items' => $pagination,
            //'pagination' => $pagination,
        ));
    }
    /**
     * @Route("/item/edit/{id}", name="edit_item")
     */
    public function editAction($id, Request $request)
    {
        $item = $this->getDoctrine()
        ->getRepository('AppBundle:Item')
        ->find($id);

        $form = $this->createFormBuilder($item)
        ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('price', IntegerType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('available', ChoiceType::class, array('choices'  => array('Yes' => 1,'No' => 0),'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('save', SubmitType::class, array('label' => 'Update Item','attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
        ->getForm();

     $form->handleRequest($request);
     
     if($form->isSubmitted() && $form->isValid()){
        $item = $form->getData();
        $em = $this->getDoctrine()->getManager();
        $em->persist($item);
        $em->flush();

        $this->addFlash(
            'notice',
            'Item Updated'
        );
        return $this->redirectToRoute('view_items');
     }
   

        // replace this example code with whatever you need
      return $this->render('item/edit.html.twig', array(
            'item' =>$item,
            'form' => $form->createView(),
      ));
    }
        /**
     * @Route("/item/view/{id}", name="view_item")
     */
    public function viewAction($id,Request $request)
    {
        $item = $this->getDoctrine()
        ->getRepository('AppBundle:Item')
        ->find($id);
        // replace this example code with whatever you need
        return $this->render('item/view.html.twig', array(
            'item' => $item
        ));
    }


}
