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
        
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Article');
        
       $article = $repo->find($id);
       if($article){
           $article->setActive(false);
           $em->persist($article);
           $em->flush();
       }
        
        return $this->redirectToRoute('articles_liste');
    }
    
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Article');
        $articles = $repo->getActiveArticles();
   
        return $this->render('AppBundle:articles:liste_articles.html.twig',['articles' => $articles]);
    }
    
}



