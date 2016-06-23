<?php

namespace AppBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Repository\LigneCommandeRepository;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LigneCommandeRepository")
 */
class LigneCommande {
    
   /**
    * @ORM\Id
    * @ORM\ManyToOne(targetEntity="Commande")
    */
    private $commande;
    
    /** 
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Article")
     */
    private $article;
    
     /**
     * @ORM\Column(type="integer")
     */
    private $quantiteTotal;
    
    
     /**
     * @ORM\Column(type="integer")
     */
    private $quantiteEnCours;

    
   
    function getCommande() {
        return $this->commande;
    }

    function getArticle() {
        return $this->article;
    }

    function getQuantiteTotal() {
        return $this->quantiteTotal;
    }

    function getQuantiteEnCours() {
        return $this->quantiteEnCours;
    }

    function setCommande($commande) {
        $this->commande = $commande;
    }

    function setArticle($article) {
        $this->article = $article;
    }

    function setQuantiteTotal($quantiteTotal) {
        $this->quantiteTotal = $quantiteTotal;
    }

    function setQuantiteEnCours($quantiteEnCours) {
        $this->quantiteEnCours = $quantiteEnCours;
    }
    
    function __construct($commande=null, $article=null, $quantiteTotal=null, $quantiteEnCours=null) {
        $this->commande = $commande;
        $this->article = $article;
        $this->quantiteTotal = $quantiteTotal;
        $this->quantiteEnCours = $quantiteEnCours;
    }

}
