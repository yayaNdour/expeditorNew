<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity;


class ArticleController extends Controller {
    
    public function updateAction(Request $request,$id=null)
    {
        $formFactory = Forms::createFormFactory();
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Article');
        
        $article = $repo->find($id);
        
       
      $form = $formFactory->createBuilder()
              ->add('nom','text')
              ->add('poids','number')
              ->add('prix','number')
              ->add('submit','submit')
              ->getForm();
      
      
     /* if($request)
       $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();
            exit(var_dump($data));
            $article = new Article();
                
            $response = new RedirectResponse('/task/success');
            $response->prepare($request);

            return $response->send();
        }*/
       
        return $this->render('AppBundle:articles:edit_article.html.twig',['form' => $form->createView()]);
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



