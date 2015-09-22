<?php

namespace Auctores\BlogBundle\Entity;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends \Doctrine\ORM\EntityRepository
{

    public function getList($page=1, $artOnPage=10)
    {
        return new Paginator($this->getEntityManager()
            ->createQuery(
                'SELECT a
                FROM AuctoresBlogBundle:Article a
                ORDER BY a.date DESC'
            )
            ->setFirstResult(($page-1) * $artOnPage)
                ->setMaxResults($artOnPage));
    }

    public function getCount()
    {
        return count($this->getEntityManager()
            ->createQuery(
                'SELECT a
                FROM AuctoresBlogBundle:Article a'
            )->getArrayResult());

    }
}