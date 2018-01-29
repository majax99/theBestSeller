<?php

namespace AppBundle\Repository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends \Doctrine\ORM\EntityRepository
{
    public function countProductCategory()
    {
        return $this
            ->createQueryBuilder('c')
            ->select('c')
            ->leftJoin('c.products', 'p')
            ->addSelect('p')
            ->leftJoin('p.orders', 'o')
            ->addSelect('o')
            ->andWhere(' o.product is null')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function productByCategory($id)
    {
        return $this
            ->createQueryBuilder('c')
            ->select('c')
            ->leftJoin('c.products', 'p')
            ->addSelect('p')
            ->where('c.id = :id')
            ->setParameter('id', $id)
            ->orderBy('p.biddingEnd', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
}
