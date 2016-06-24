<?php

namespace UserBundle\Entity; 

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 */
class Utilisateur extends BaseUser{
    

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    
    
    protected $test;
    
    function getTest() {
        return $this->test;
    }

    function setTest($test) {
        $this->test = $test;
    }


}
