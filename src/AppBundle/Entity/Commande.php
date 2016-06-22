<?php

namespace AppBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\Utilisateur;

/**
 * @ORM\Entity
 */
class Commande {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string")
     */
    private $numCommande;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $etat;
    
    /**
    * @ORM\Column(type="integer")
    */
    private $date;
    
    /**
    * @ORM\Column(type="integer")
    */
    private $dateTraitement;
    

    /** 
     * @ORM\Column(type="string", length=500)
     */
    private $commentaire;
    
   
    /**
     * @ORM\OneToMany(targetEntity="LigneCommande", mappedBy="article")
     */
    private $ligneCommande;
    
    /**
     *
     * @ORM\OneToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client", referencedColumnName="id")
     * })
     */
    private $client;
    
    /**
     * 
     * @ORM\Column(name="employe", type="integer")
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="employe", referencedColumnName="id")
     * })
     */
    private $employe;
            
    function getId() {
        return $this->id;
    }
    
    function getNumCommande() {
        return $this->numCommande;
    }

    function getEtat() {
        return $this->etat;
    }

    function getDate() {
        return $this->date;
    }

    function getDateTraitement() {
        return $this->dateTraitement;
    }

    function getCommentaire() {
        return $this->commentaire;
    }

        
    
    function setId($id) {
        $this->id = $id;
    }
    
    function setNumCommande($numCommande) {
        $this->numCommande = $numCommande;
    }

    function setEtat($etat) {
        $this->etat = $etat;
    }

    function setDate($date) {
        $this->date = $date;
    }
    
    function setDateTraitement($dateTraitement) {
        $this->dateTraitement = $dateTraitement;
    }

    function setCommentaire($commentaire) {
        $this->commentaire = $commentaire;
    }

        
        
    function __construct($numCommande, $etat, $date, $dateTraitement, $commentaire) {
        $this->numCommande = $numCommande;
        $this->etat = $etat;
        $this->date = $date;
        $this->dateTraitement = $dateTraitement;
        $this->commentaire = $commentaire;
    }



    
}
