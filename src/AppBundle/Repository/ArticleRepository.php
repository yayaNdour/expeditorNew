<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository {
    
    /**
     * Retunr la liste des articles actifs
     * @return type
     */
    public function getActiveArticles(){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a FROM AppBundle:Article a WHERE a.active=1'
            )
            ->getResult();
    }
    
}
