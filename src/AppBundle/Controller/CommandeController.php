<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class CommandeController extends Controller {
    
    public function showAction($id)
    {
        return new Response('<html><body>Commande !</body></html>');
    }
    
    public function freeAction($id)
    {
        return new Response('<html><body>free Commande !</body></html>');
    }
    
    public function updateAction($id)
    {
        return new Response('<html><body>update Commande !</body></html>');
    }
    
    public function finishAction($id)
    {
        return new Response('<html><body>finish Commande !</body></html>');
    }
    
    public function printAction($id)
    {
        return new Response('<html><body>print Commande !</body></html>');
    }
    
    public function indexAction()
    {
        return new Response('<html><body>Liste commandes !</body></html>');
    }
    
    public function startAction()
    {
        return new Response('<html><body>Commencer commandes !</body></html>');
    }
    
}
