<?php

namespace MDurys\GupekBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * BoutRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BoutRepository extends EntityRepository
{
    /**
     * Get query builder, which selects a bouts for given meeting.
     *
     * @param int $meeting
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function queryByMeeting($meeting)
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('b')
            ->from(Bout::class, 'b')
            ->where('b.meeting = :meeting')
            ->setParameter('meeting', $meeting);
    }

    /**
     * @param int $meeting
     * @return array
     */
    public function getJoinUserAndGameByMeeting($meeting)
    {
        $qb = $this->queryByMeeting($meeting);
        return $qb
            ->select('b, mu, u, g')
            ->leftJoin('b.meetingUsers', 'mu')
            ->leftJoin('mu.user', 'u')
            ->innerJoin('b.game', 'g')
            ->orderBy('b.id, mu.place, u.username')
            ->getQuery()
            ->getResult();
    }
}
