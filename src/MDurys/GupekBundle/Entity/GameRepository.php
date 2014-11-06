<?php

namespace MDurys\GupekBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * GameRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GameRepository extends EntityRepository
{
    /**
     * Get query builder, which selects a game by slug.
     *
     * @param int $seasonId
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function queryBySlug($slug)
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('g')
            ->from($this->getEntityName(), 'g')
            ->where('m.slug = :slug')
            ->setParameter('slug', $slug);
    }

    /**
     * Get Game entity by slug.
     *
     * @param string $slug
     * @return null|\MDurys\GupekBundle\Entity\Game
     */
    public function getBySlug($slug)
    {
        return $this->queryBySlug($slug)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
