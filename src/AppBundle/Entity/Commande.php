<?php

namespace AppBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\Utilisateur;
use AppBundle\Repository\CommandeRepository;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommandeRepository")
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
     * @ORM\Column(type="integer")
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
     * @ORM\Column(type="string", length=500)
     */
    private $nomClient;
    

    /** 
     * @ORM\Column(type="string", length=500)
     */
    private $adresseClient;
    
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Utilisateur")
     * @ORM\JoinColumn(nullable=true)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="employe", referencedColumnName="id")
     * })
     */
    private $employe;
    
    
    function __construct($id=null, $numCommande=null, $etat=null, $date=null, $dateTraitement=null, $commentaire=null, $ligneCommande=null, $nomClient=null, $adresseClient=null, $employe=null) {
        $this->id = $id;
        $this->numCommande = $numCommande;
        $this->etat = $etat;
        $this->date = $date;
        $this->dateTraitement = $dateTraitement;
        $this->commentaire = $commentaire;
        $this->ligneCommande = $ligneCommande;
        $this->nomClient = $nomClient;
        $this->adresseClient = $adresseClient;
        $this->employe = $employe;
    }
    
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

    function getLigneCommande() {
        return $this->ligneCommande;
    }

    function getNomClient() {
        return $this->nomClient;
    }

    function getAdresseClient() {
        return $this->adresseClient;
    }

    function getEmploye() {
        return $this->employe;
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

    function setLigneCommande($ligneCommande) {
        $this->ligneCommande = $ligneCommande;
    }

    function setNomClient($nomClient) {
        $this->nomClient = $nomClient;
    }

    function setAdresseClient($adresseClient) {
        $this->adresseClient = $adresseClient;
    }

    function setEmploye($employe) {
        $this->employe = $employe;
    }



    
}
