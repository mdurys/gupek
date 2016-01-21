<?php

namespace MDurys\GupekBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MeetingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MeetingRepository extends EntityRepository
{
    /**
     * Get query builder, which selects all meetings from given season.
     *
     * @param int | Season $season
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function queryBySeason($season)
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('m')
            ->from(Meeting::class, 'm')
            ->where('m.season = :season')
            ->setParameter('season', $season);
    }

    /**
     * Get meetings from given season.
     *
     * @param int | Season $season
     * @return array
     */
    public function getBySeason($season)
    {
        return $this->queryBySeason($season)
            ->getQuery()
            ->getResult();
    }

    /**
     * Get list of meeting statistics for given season. Each array row has the
     * following keys:
     * - id
     * - date
     * - bouts
     * - games
     * - users
     *
     * @param int|\MDurys\GupekBundle\Entity\Season $season
     * @return array
     */
    public function getDetailsBySeason($season)
    {
        $qb = $this->queryBySeason($season);
        $qb
            ->select('m.id, m.date, COUNT(DISTINCT b.id) AS bouts, COUNT(DISTINCT b.game) AS games, COUNT(DISTINCT mu.user) AS users')
            ->leftJoin('m.bouts', 'b')
            ->leftJoin('m.meetingUsers', 'mu')
            ->groupBy('m.id');

        return $qb->getQuery()->getResult();
    }
}
