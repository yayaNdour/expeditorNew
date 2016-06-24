<?php

namespace UserBundle\Repository;

use Doctrine\ORM\EntityRepository;

class EmployeRepository extends EntityRepository {
    

    public function getEnabledEmploye(){
        return $this->getEntityManager()
            ->createQuery(
                "SELECT e FROM UserBundle:Utilisateur e WHERE e.enabled=1 and e.roles like '%ROLE_EMPLOYE%' "
            )
            ->getResult();
    }
    
}
