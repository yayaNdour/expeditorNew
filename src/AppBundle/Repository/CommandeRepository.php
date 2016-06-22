<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CommandeRepository extends EntityRepository {
    
    /**
     * Retunr la liste des articles actifs
     * @return type
     */
    public function getActiveCommandes(){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM AppBundle:Commande c WHERE c.etat<2 order by c.etat desc, c.date asc'
            )
            ->getResult();
    }
    
}
