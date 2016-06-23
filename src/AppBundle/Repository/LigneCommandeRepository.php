<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class LigneCommandeRepository extends EntityRepository {
    
    public function getLigneCommande($id){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT l FROM AppBundle:LigneCommande l WHERE l.commande='.$id
            )
            ->getResult();
    }
    
    public function getLigneCommandeArticle($id, $article){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT l FROM AppBundle:LigneCommande l WHERE l.commande='.$id.' and l.article='.$article
            )
            ->getResult();
    }
    
}
