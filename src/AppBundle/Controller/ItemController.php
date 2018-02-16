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
            ->add('available', ChoiceType::class, array('choices'  => array('Yes' => 'Yes','No' => 'No'),'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('save', SubmitType::class, array('label' => 'Create New Item','attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
            ->getForm();

         $form->handleRequest($request);
         
         if($form->isSubmitted() && $form->isValid()){
             die("Form Submitted");
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
        die("DELETE");
        // replace this example code with whatever you need
       // return $this->render('item/create.html.twig', []);
    }

        /**
     * @Route("/item/list", name="view_items")
     */
    public function listAction(Request $request)
    {
        $items = $this->getDoctrine()
        ->getRepository('AppBundle:Item')
        ->findAll();
        // replace this example code with whatever you need
        return $this->render('item/list.html.twig', array(
            'items' => $items
        ));
    }

}
