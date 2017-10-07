<?php

namespace MDurys\GupekBundle\Entity;

use Doctrine\ORM\EntityRepository;
use MDurys\GupekBundle\Domain\Meeting\MeetingRepositoryInterface;
use MDurys\GupekBundle\Domain\Meeting\SeasonInterface;

/**
 * MeetingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MeetingRepository extends EntityRepository implements MeetingRepositoryInterface
{
    /**
     * Get query builder, which selects all meetings from given season.
     *
     * @param int | SeasonInterface $season
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
     * @inheritdoc
     */
    public function getBySeason(SeasonInterface $season): array
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

    /**
     * @param int $limit
     * @return array
     */
    public function getUpcoming(int $limit = 5)
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('m')
            ->from(Meeting::class, 'm')
            ->where('m.date > CURRENT_TIMESTAMP()')
            ->orderBy('m.date', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $limit
     * @return array
     */
    public function getRecent(int $limit = 5)
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('m')
            ->from(Meeting::class, 'm')
            ->where('m.date < CURRENT_TIMESTAMP()')
            ->orderBy('m.date', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
