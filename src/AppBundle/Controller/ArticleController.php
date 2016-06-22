<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class ArticleController extends Controller {
    public function updateAction($id)
    {
        return new Response('<html><body>Update Article !</body></html>');
    }
    
    public function removeAction($id)
    {
        return new Response('<html><body>Remove Article !</body></html>');
    }
    
    public function indexAction()
    {
        return new Response('<html><body>Liste Articles !</body></html>');
    }
    
}



