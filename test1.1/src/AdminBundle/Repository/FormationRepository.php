<?php

/**
 * Created by PhpStorm.
 * User: debba
 * Date: 3/29/2019
 * Time: 7:06 PM
 */
namespace AdminBundle\Repository;
class FormationRepository extends \Doctrine\ORM\EntityRepository
{


    public function findEntitiesByString($str)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT f
                FROM UserBundle:Formation f
                WHERE f.nom LIKE :str '
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();

    }
}
