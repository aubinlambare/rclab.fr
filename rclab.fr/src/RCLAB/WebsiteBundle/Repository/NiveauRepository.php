<?php

namespace RCLAB\WebsiteBundle\Repository;

/**
 * NiveauRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NiveauRepository extends \Doctrine\ORM\EntityRepository
{
    public function findNiveau()
    {
        return $this->createQueryBuilder('n')
            ->select('n.matiere')
            ->getQuery()
            ->getArrayResult();
    }
}
