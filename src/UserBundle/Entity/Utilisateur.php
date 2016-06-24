<?php

namespace UserBundle\Entity; 

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use UserBundle\Repository\EmployeRepository;


/**
 * @ORM\Entity(repositoryClass="UserBundle\Repository\EmployeRepository")
 */
class Utilisateur extends BaseUser{
    

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    
    
}
