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
       $employes = $repo->findAll();
       
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
           ->add('test', 'choice', [
                'choices' => [
                    'ROLE_MANAGER' => 'Manager', 
                    'ROLE_EMPLOYE' => 'Employe',
                ]
            ])
           ->add('sauvegarder','submit')
           ->getForm();   
       $form->handleRequest($request);
        if ($form->isValid()) {
            $roles[] = $utilisateur->getTest();
            $utilisateur->setRoles($roles);
            $utilisateur->setEnabled(true);
            $utilisateur->setPlainPassword($utilisateur->getPassword());
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
           //->add('password','text')
           ->add('test', 'choice', [
                'choices' => [
                    'ROLE_MANAGER' => 'Manager', 
                    'ROLE_EMPLOYE' => 'Employe',
                ]
            ])
           ->add('modifier','submit')
           ->getForm();
        
        if ($form->isValid())
        {
           $roles[] = $utilisateur->getTest();
           $utilisateur->setRoles($roles);
           $userManager->updateUser($utilisateur);
           $em->flush();
           return $this->redirectToRoute('employes_liste');
        }
        
        return $this->render('AppBundle:employes:modification_employes.html.twig',['form' => $form->createView()]);
    }
    
    public function removeAction($id)
    {
        
    }
}