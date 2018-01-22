<?php

namespace AppBundle\Repository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{
    public function myFindAll()
    {
        return $this
            ->createQueryBuilder('p')
            ->leftJoin('p.images', 'i')
            ->addSelect('i')
            ->getQuery()
            ->getResult()
            ;
    }
}