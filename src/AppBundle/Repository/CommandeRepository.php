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
    
    
    /**
     * Return le nombre de commande par utilisateur pour un jour donnée
     * @param type $start_time
     * @param type $end_time
     * @return type
     */
    public function getNbFinishedCommandeByEmploye($start_time,$end_time){
        
        //todo: retourner pour chaque employé son nombre de commande
        return $this->getEntityManager()
           ->createQuery(
               'SELECT u.username,count(u.id) '
                   . 'FROM AppBundle:Commande c JOIN UserBundle:Utilisateur u '
                   . 'WHERE u.id=c.employe '
                   . 'AND c.etat=2 '
                   . 'AND c.dateTraitement BETWEEN :start_time AND :end_time '
                   . 'GROUP BY u.id')
                ->setParameter('start_time', $start_time)
                ->setParameter('end_time', $end_time)
    //SELECT username,count(Utilisateur.id) FROM Commande JOIN Utilisateur WHERE Utilisateur.id=employe_id and etat=2 group by Utilisateur.id

           ->getResult();
        
    }
    
}
