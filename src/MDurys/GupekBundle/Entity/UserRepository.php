<?php

namespace MDurys\GupekBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    /**
     * Get users participating in given meeting.
     *
     * @param Meeting $meeting
     *
     * @return User[]
     */
    public function getByMeeting(Meeting $meeting)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        return $this
            ->getEntityManager()
            ->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u')
            ->join(MeetingUser::class, 'mu', Expr\Join::WITH, 'u.id = mu.user')
            ->join('mu.meeting', 'm')
            ->where('m.id = :meeting')->setParameter('meeting', $meeting)
            ->orderBy('u.username')
            ->getQuery()
            ->getResult();
    }
}