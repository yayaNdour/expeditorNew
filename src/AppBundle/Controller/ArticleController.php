<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Article;


class ArticleController extends Controller {
    
    public function updateAction(Request $request,Article $id = null)
    {
        $em = $this->getDoctrine()->getManager();

        if($id == null){
            $article = new Article();
        } else{
            $article = $id;
        }
       
      $form = $this->createFormBuilder($article)
              ->add('nom','text', ['label'=> 'Nom: '])
              ->add('poids','number',['label'=> 'Poids(g): '])
              ->add('prix','number',['label'=> 'Prix(€): '])
              ->add('submit','submit')
              ->getForm();
      
      
       $form->handleRequest($request);
        if ($form->isValid()) {
            $article->setActive(true);
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('articles_liste');
        }
       
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



