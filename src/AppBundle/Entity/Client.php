<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Client {
    /**
     * 
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * Get Id
     * 
     * @return Id
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Set Id
     * 
     * @param type $id
     */
    public function setId($id) {
        $this->id = $id;
    }
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     */
    private $nom;
    
    /**
     * Get nom
     * 
     * @return nom
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set nom
     * 
     * @param type $nom
     */
    public function setNom($nom) {
        $this->nom = $nom;
    }

    
        
    
    /**
     *
     * @var string
     * 
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */
    private $adresse;
    
    /**
     * Get adresse
     * 
     * @return adresse
     */
    public function getAdresse() {
        return $this->adresse;
    }
    
    /**
     * Set adresse
     * 
     * @param type $adresse
     */
    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }
    
    /**
     * Constructor
     * 
     * @param type $nom
     * @param type $adresse
     */
    public function __construct($nom, $adresse) {
        $this->nom = $nom;
        $this->adresse = $adresse;
    }
    
    /**
     * 
     * @return toString
     */
    public function __toString() {
        return $this->nom;
    }

}
