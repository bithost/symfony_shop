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
     * @Route("/order/view", name="view")
     */
    public function viewAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('order/view.html.twig', [
        ]);
    }
        /**
     * @Route("/order/fakedata", name="fakedata")
     */
    public function insertDataAction(Request $request)
    {
      
        $em = $this->getDoctrine()->getManager();
        $RAW_QUERY = 'INSERT INTO `orders` (`id`,`customer_name`,`quantity`,`total_price`,`order_status`) VALUES (100,"Noel Miller",1,12,2),(101,"Christopher Arnold",130,249,3),(102,"Glenna Roth",259,486,1),(103,"Elijah Simpson",388,723,1),(104,"Candace Fuentes",517,960,3),(105,"Jonah Henderson",646,1197,3),(106,"Phoebe Duncan",775,1434,3),(107,"Alfonso Kane",904,1671,4),(108,"Orlando Spears",1033,1908,2),(109,"May Watson",1162,2145,3),(110,"Eden Hooper",1291,2382,2),(111,"Moana Carlson",1420,2619,3),(112,"Walker Monroe",1549,2856,4),(113,"Reece Payne",1678,3093,3),(114,"Lawrence Lambert",1807,3330,2),(115,"Brent Vaughn",1936,3567,4),(116,"Malachi Shaffer",2065,3804,1),(117,"Rana Alvarez",2194,4041,4),(118,"Guy Gaines",2323,4278,1),(119,"Imelda Clark",2452,4515,1),(120,"Charde Burgess",2581,4752,3),(121,"Arthur Wolf",2710,4989,3),(122,"Lev Roth",2839,5226,2),(123,"Vance Nieves",2968,5463,2),(124,"Zelda Johns",3097,5700,4),(125,"Phyllis Shepard",3226,5937,3),(126,"Rhea Douglas",3355,6174,1),(127,"Andrew Donovan",3484,6411,3),(128,"Forrest Mayer",3613,6648,4),(129,"Roary Byers",3742,6885,4),(130,"Ivory Douglas",3871,7122,3),(131,"Fletcher Reese",4000,7359,2),(132,"Curran Benson",4129,7596,3),(133,"Troy Harper",4258,7833,2),(134,"Kenyon William",4387,8070,1),(135,"Rebekah Moreno",4516,8307,1),(136,"Allegra Hubbard",4645,8544,1),(137,"Kirsten Montoya",4774,8781,4),(138,"Ingrid Hooper",4903,9018,3),(139,"Thane Riley",5032,9255,3),(140,"Jessica Cameron",5161,9492,2),(141,"Giselle Newman",5290,9729,4),(142,"Kelly Chaney",5419,9966,1),(143,"Gray Rasmussen",5548,10203,3),(144,"Griffin Alford",5677,10440,2),(145,"Finn Richards",5806,10677,3),(146,"Maya Dotson",5935,10914,2),(147,"Nola Michael",6064,11151,1),(148,"Autumn Payne",6193,11388,2),(149,"Christian Hickman",6322,11625,2),(150,"Amena Ferguson",6451,11862,1),(151,"Rylee Mccarty",6580,12099,2),(152,"Nell Christensen",6709,12336,4),(153,"Victoria Hudson",6838,12573,4),(154,"Carter Marquez",6967,12810,1),(155,"Phoebe Joyner",7096,13047,2),(156,"Thane Levine",7225,13284,1),(157,"Randall Welch",7354,13521,1),(158,"Allen Nash",7483,13758,4),(159,"Wayne Wilkins",7612,13995,3),(160,"Brennan Raymond",7741,14232,2),(161,"Ginger Bryan",7870,14469,4),(162,"Abigail Richard",7999,14706,3),(163,"Yoko Willis",8128,14943,2),(164,"Carlos Harmon",8257,15180,2),(165,"Chadwick Kirkland",8386,15417,4),(166,"Walker King",8515,15654,4),(167,"Mechelle Hendricks",8644,15891,4),(168,"Cooper Horn",8773,16128,3),(169,"Rylee Klein",8902,16365,3),(170,"Suki Glass",9031,16602,1),(171,"Wesley Dudley",9160,16839,2),(172,"Bell Bullock",9289,17076,1),(173,"Christian Stark",9418,17313,4),(174,"Brent Hess",9547,17550,3),(175,"Halee Bates",9676,17787,2),(176,"Aaron Mcgee",9805,18024,4),(177,"Mona Case",9934,18261,3),(178,"Tanek Austin",10063,18498,2),(179,"Dean Boyd",10192,18735,1),(180,"Sylvia Shelton",10321,18972,1),(181,"Deirdre Burks",10450,19209,4),(182,"Alvin Sheppard",10579,19446,3),(183,"Carlos Harris",10708,19683,1),(184,"Russell Weaver",10837,19920,4),(185,"Deacon Contreras",10966,20157,1),(186,"Moana Barry",11095,20394,4),(187,"Vivian Abbott",11224,20631,1),(188,"Ariel Kelley",11353,20868,2),(189,"Jerry Dalton",11482,21105,3),(190,"Robert Luna",11611,21342,2),(191,"Adara Parks",11740,21579,4),(192,"Victoria Cochran",11869,21816,2),(193,"Ethan Sexton",11998,22053,2),(194,"Magee Herring",12127,22290,4),(195,"Emma Gill",12256,22527,3),(196,"Fletcher Delaney",12385,22764,1),(197,"Macey Whitfield",12514,23001,4),(198,"Chiquita Garza",12643,23238,4),(199,"Benjamin Greene",12772,23475,2);';
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $em->persist($statement);
        $em->flush();
        return $this->redirectToRoute('list_orders');
     }
    }
}
