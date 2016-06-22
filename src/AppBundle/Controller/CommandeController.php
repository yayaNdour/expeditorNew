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
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Commande');
        
        $commande = $repo->find($id);
        if($commande){
           $commande->setEmploye(null);
           $commande->setEtat(0);
           $em->persist($commande);
           $em->flush();
        }
        
        return $this->redirectToRoute('commandes_liste');
    }
    
    public function updateAction($id)
    {
        return new Response('<html><body>update Commande !</body></html>');
    }
    
    public function finishAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Commande');
        
        $commande = $repo->find($id);
        if($commande){
           $commande->setEtat(2);
           $commande->setDateTraitement(time());
           $em->persist($commande);
           $em->flush();
        }
        
        return $this->redirectToRoute('commandes_liste');
    }
    
    public function printAction($id)
    {
        return new Response('<html><body>print Commande !</body></html>');
    }
    
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Commande');
        $commandes = $repo->getActiveCommandes();
   
        return $this->render('AppBundle:commandes:liste_commandes.html.twig',['commandes' => $commandes]);
    }
    
    public function nextAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Commande');
        $commandes = $repo->getActiveCommandes();
        if(count($commandes)>0){
            foreach ($commandes as $commande){
            if($commande->getEtat()==0 || $commande->getEmploye()->getId()==$this->getUser()->getId()){
                $commande->setEtat(1);
                $commande->setEmploye($this->getUser());
                $em->persist($commande);
                $em->flush();
                return $this->redirectToRoute('commande_show', array('id' => $commande->getId()));
            }
            }
        }
        return $this->redirectToRoute('commandes_liste');
    }
    
    public function importAction()
    {
        return new Response('<html><body>Import de commandes !</body></html>');
    }
    
}
