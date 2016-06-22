<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class LigneCommandeRepository extends EntityRepository {
    
    /**
     * Retunr la liste des articles actifs
     * @return type
     */
    public function getLigneCommande($id){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT l FROM AppBundle:LigneCommande l WHERE l.commande='.$id
            )
            ->getResult();
    }
    
}
