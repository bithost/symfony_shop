<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ItemController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('item/index.html.twig', [
        ]);
    }
    /**
     * @Route("/item/create", name="new_item")
     */
    public function createAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('item/create.html.twig', []);
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

}
