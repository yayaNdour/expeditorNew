<?php
// src/AppBundle/Entity/Article.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Repository\ArticleRepository;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $poids;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $prix;
    
    /**
     * @ORM\Column(type="boolean", options={"default":true})
     */
    private $active;
    
    function getActive() {
        return $this->active;
    }

    function setActive($active) {
        $this->active = $active;
    }

        function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPoids() {
        return $this->poids;
    }

    function getPrix() {
        return $this->prix;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPoids($poids) {
        $this->poids = $poids;
    }

    function setPrix($prix) {
        $this->prix = $prix;
    }

   
    
    function __construct($nom=null, $poids=null, $prix=null) {
        $this->nom = $nom;
        $this->poids = $poids;
        $this->prix = $prix;
    }


    
}
?>