<?php

namespace AppBundle\Controller;

use UserBundle\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class EmployeController extends Controller {
    
    public function indexAction()
    {
       $em= $this->getDoctrine()->getManager();
       $repo = $em->getRepository('UserBundle:Utilisateur');
       $employes = $repo->getEnabledEmploye();
       
        return $this->render('AppBundle:employes:liste_employes.html.twig',['employes' => $employes]);
    }
    public function createAction(Request $request)
    {
        $userManager = $this->container->get('fos_user.user_manager');    
       $em = $this->getDoctrine()->getManager();           
        $utilisateur = $userManager->createUser();      
      $form = $this->createFormBuilder($utilisateur)
           ->add('username','text')
           ->add('email','text')
           ->add('password','text')
           ->add('sauvegarder','submit')
           ->getForm();   
       $form->handleRequest($request);
        if ($form->isValid()) {
            $utilisateur->setRoles(array('ROLE_EMPLOYE'));
            $utilisateur->setEnabled(true);
            $utilisateur->setPlainPassword($utilisateur->getPassword());
            $userManager->updateUser($utilisateur);
            $em->flush();            
            return $this->redirectToRoute('employes_liste');
        }      
        return $this->render('AppBundle:employes:creation_employes.html.twig',['form' => $form->createView()]);       
    }
    
    public function updateAction(Request $request,Utilisateur $id)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $em = $this->getDoctrine()->getManager();
        $utilisateur = $id;
        
        $form = $this->createFormBuilder($utilisateur)
           ->add('username','text')
           ->add('email','text')
           ->add('modifier','submit')
           ->getForm();
        
        $form->handleRequest($request);
        if ($form->isValid())
        {
           $userManager->updateUser($utilisateur);
           $em->flush();
           return $this->redirectToRoute('employes_liste');
        }
        
        return $this->render('AppBundle:employes:modification_employes.html.twig',['form' => $form->createView()]);
    }
    
    public function removeAction($id)
    {
         
       $em = $this->getDoctrine()->getManager();
       $repo = $em->getRepository('UserBundle:Utilisateur');
        
       $utilisateur = $repo->find($id);
       if($utilisateur){
           $utilisateur->setEnable(false);
           $em->persist($utilisateur);
           $em->flush();
       }
        
        return $this->redirectToRoute('employes_liste');
        
        
    }
}