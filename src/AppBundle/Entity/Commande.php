<?php

namespace AppBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\OneToMany(targetEntity="LigneCommande", mappedBy="article")
     */
    private $ligneCommande;
    
    /**
     * @var \ENI\QCM\Bundle\StagiaireBundle\Entity\Theme
     *
     * @ORM\OneToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client", referencedColumnName="id")
     * })
     */
    private $client;
    
    /**
     * @ORM\Column(nullable=true)
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="employe", referencedColumnName="id")
     * })
     */
    private $employe;
            
    function getId() {
        return $this->id;
    }

    function getEtat() {
        return $this->etat;
    }

    function getDate() {
        return $this->date;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEtat($etat) {
        $this->etat = $etat;
    }

    function setDate($date) {
        $this->date = $date;
    }
    function getNumCommande() {
        return $this->numCommande;
    }

    function setNumCommande($numCommande) {
        $this->numCommande = $numCommande;
    }

        
    function __construct($etat, $date) {
        $this->etat = $etat;
        $this->date = $date;
    }


    
}
