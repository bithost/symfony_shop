<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    /**
     * @Route("/order/create", name="create")
     */
    public function createAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('order/create.html.twig', [
        ]);
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
     * @Route("/order/list", name="list")
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
