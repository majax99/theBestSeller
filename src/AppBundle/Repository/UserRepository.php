<?php

namespace AppBundle\Repository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public function MyFindAll()
    {
        return $this
            ->createQueryBuilder('u')
            ->leftJoin('u.products', 'p')
            ->addSelect('p')
            ->getQuery()
            ->getResult()
            ;
    }

    public function MyProductByUser()
    {
        return $this
            ->createQueryBuilder('u')
            ->select('u')
            ->leftJoin('u.userRates', 'ur')
            ->addSelect('ur')
            ->leftJoin('u.products', 'p')
            ->addSelect('p')

            ->leftJoin('u.orders', 'o')
            ->addSelect('o')
            ->getQuery()
            ->getResult()
            ;
    }

    public function MyUserRate($id)
    {
        return $this
            ->createQueryBuilder('u')
            ->select('u')
            ->leftJoin('u.userRates', 'ur')
            ->addSelect('ur')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
            ;
    }

    public function MyProductToSellByUser($id)
    {
        return $this
            ->createQueryBuilder('u')
            ->select('u')
            ->leftJoin('u.products', 'p')
            ->addSelect('p')
            ->leftJoin('p.images', 'i')
            ->addSelect('i')

            ->leftJoin('u.orders', 'o')
            ->addSelect('o')
            ->getQuery()
            ->getResult()
            ;
    }


}
