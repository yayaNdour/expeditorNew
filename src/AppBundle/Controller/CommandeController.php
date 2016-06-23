<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Commande;
use AppBundle\Entity\LigneCommande;


class CommandeController extends Controller {
    
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Commande');
        
        $commande = $repo->find($id);
        if(!$commande){
            return $this->redirectToRoute('commandes_liste');
        }
        $repo = $em->getRepository('AppBundle:LigneCommande');
        $lignes = $repo->getLigneCommande($id);
        
        return $this->render('AppBundle:commandes:detail_commande.html.twig',['commande' => $commande, 'lignes' => $lignes]);
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
    
    public function updateAction($id, $articleId, $qte)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Commande');
        $commande = $repo->find($id);
        $repo = $em->getRepository('AppBundle:Article');
        $article = $repo->find($articleId);
        if(!$article || !$commande)
            return new Response('');
        $repo = $em->getRepository('AppBundle:LigneCommande');
        $lignes = $repo->getLigneCommandeArticle($id, $articleId);
        foreach ( $lignes as $ligne){
            $ligne->setQuantiteEnCours($qte);
            $em->persist($ligne);
            $em->flush();
        }
        return new Response('');
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
                $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Commande');
        
        $commande = $repo->find($id);
        if(!$commande){
            return $this->redirectToRoute('commandes_liste');
        }
        $repo = $em->getRepository('AppBundle:LigneCommande');
        $lignes = $repo->getLigneCommande($id);
        
        return $this->render('AppBundle:commandes:print_commande.html.twig',['commande' => $commande, 'lignes' => $lignes]);
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
        
        $filePath = "C:\Users\d1410galipauda\Desktop\JEU DE DONNEES\CSV.csv";
        //$filePath = "C:\Users\d1410galipauda\Desktop\JEU DE DONNEES\XLS.xls";
        
        $commandes = $this->csvReader($filePath);
        //$commandes = $this->xlsReader($filePath);
        
        
        return new Response('<html><body>'.var_dump($commandes).'</body></html>');
         
    }
    
    private function csvReader($filePath){
        
        $commandes=array();
        $em = $this->getDoctrine()->getManager();
        $row = 1;
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            while (($dataFile = fgetcsv($handle, 0, ",")) !== FALSE) {
                $num = count($dataFile);
                
                if($row>1){
                    $commande = new Commande();
                    $ligneCommandes = new LigneCommande();

                    for ($c=0; $c < $num; $c++) {
                        $this->constructCommande($commande,$ligneCommandes, $dataFile[$c], $c);
                    }
                    
                    $repo = $em->getRepository('AppBundle:Commande');
        
                    $commandeBDD = $repo->findBy(array('numCommande' => $commande->getNumCommande()));
                    
                    //If Commande not exist
                    //Insert
                    if(is_null($commandeBDD)==TRUE){
                        $commande->setEtat(2);
                        $commande->setDateTraitement(0);
                        $commande->setCommentaire("");

                        array_push($commandes,$commande);

                        $em->persist($commande);
                        $em->flush();
                    }
                    
                }
                $row++;
            }
            fclose($handle);
        }
        return $commandes;
    }
    
    private function constructCommande(&$commande,&$ligneCommandes,$value,$index){
        switch ($index) {
            case 0:
                $commande->setDate(strtotime($value));
                break;
            case 1:
                $commande->setNumCommande(substr($value, strlen("Cmd N° ")));
                break;
            case 2:
                $commande->setNomClient($value);
                break;
            case 3:
                $commande->setAdresseClient($value);
                break;
            case 4:
                /*
                foreach (explode(";",$value) as $key => $value)
                {
                    $articleName=
                    $ligneCommande = new LigneCommande();
                    $ligneCommande->se
                    $ligneCommandes
                }
                 * */
                break;
            default:
                break;
        }
    }
    
    
    public function statsAction(){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Commande');
        
        $day_start = strtotime('today midnight');
        $day_end = strtotime('tomorrow midnight');
        
        $stats = $repo->getNbFinishedCommandeByEmploye($day_start,$day_end);
        
        return $this->render('AppBundle:commandes:stats_employe.html.twig',['stats' => $stats]);

    }
    
}
