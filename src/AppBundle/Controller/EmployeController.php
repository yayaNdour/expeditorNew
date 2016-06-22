<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class EmployeController extends Controller {
    
    public function indexAction()
    {
       $em= $this->getDoctrine()->getManager();
       $repo = $em->getRepository('AppBundle:Employe');
       $employes = $repo->findAll();
    }
    public function createAction()
    {
         return new Response('<html><body>Create Articles !</body></html>');
    }
    public function removeAction($id)
    {
        
    }
}