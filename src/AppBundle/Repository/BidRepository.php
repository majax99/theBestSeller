<?php

namespace AppBundle\Repository;

/**
 * BidRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BidRepository extends \Doctrine\ORM\EntityRepository
{
    public function myFindBid($id)
    {
        return $this
            ->createQueryBuilder('b')
            ->where('b.product = :id')
            ->setParameter('id', $id)
            ->orderBy('b.bidAccount', 'DESC','b.created', 'ASC')
            //->orderBy('b.created', 'ASC')
            ->setFirstResult( 0 )
            ->setMaxResults( 2 )
            ->getQuery()
            ->getResult()
            ;
    }
}
