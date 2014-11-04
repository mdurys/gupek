<?php

namespace MDurys\GupekBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MDurys\GupekBundle\Entity\Season;
use MDurys\GupekBundle\Entity\Meeting;

class LoadSeason5Data extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $em)
    {
        $season = new Season();
        $em->persist($season);
        $em->flush();

        $meetings = [
            ['2014-09-04 19:30:00'],
            ['2014-09-11 19:30:00'],
            ['2014-09-18 19:30:00'],
            ['2014-09-25 19:30:00'],
        ];
        foreach ($meetings as $row) {
            $meeting = new Meeting();
            $meeting
                ->setSeason($season)
                ->setDate($row[0]);
            $em->persist($meeting);
            $em->flush();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 10;
    }
}
