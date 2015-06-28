<?php

namespace MDurys\GupekBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * SeasonRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SeasonRepository extends EntityRepository
{
    /**
     * Get basic information about given season: start date, end date and number of meetings.
     *
     * @param int $seasonId
     * @return array|null
     */
    public function getInfo($season)
    {
        $qb = $this->getEntityManager()
            ->getRepository('MDurysGupekBundle:Meeting')
            ->queryBySeason($seasonId);
        return $qb
            ->select([$qb->expr()->min('m.date'), $qb->expr()->max('m.date'), $qb->expr()->count('m.id')])
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Get player ranking (with details) for given season.
     *
     * @param int|\MDurys\GupekBundle\Entity\Season $season
     * @return array|null
     */
    public function getUserRanking($season)
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('
                u.id,
                u.username,
                SUM(mu.score) AS points,
                SUM(mu.win) AS wins,
                COUNT(m.id) AS meetings,
                COUNT(mu.id) AS bouts,
                (SUM(mu.score) / COUNT(mu.id)) AS power,
                (SUM(mu.win) / COUNT(mu.id)) AS efficiency,
                (CASE WHEN (COUNT(m.id) < 10) THEN 0 ELSE 1 END) AS is_classified
            ')
            ->from('MDurysGupekBundle:Meeting', 'm')
            ->innerJoin('m.meetingUsers', 'mu')
            ->innerJoin('m.season', 's')
            ->innerJoin('mu.user', 'u')
            ->where('s.id = :season')
            ->groupBy('u.id')
            ->setParameter('season', $season)
            ->getQuery()
            ->getResult();
    }
}
