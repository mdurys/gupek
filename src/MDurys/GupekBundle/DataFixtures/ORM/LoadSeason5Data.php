<?php

namespace MDurys\GupekBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MDurys\GupekBundle\Entity\Season;
use MDurys\GupekBundle\Entity\Bout;
use MDurys\GupekBundle\Entity\Meeting;
use MDurys\GupekBundle\Entity\MeetingUser;

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
            [
                '2014-09-04 19:30:00',
                'bouts' => [
                    [
                        'game' => 'imperial2030',
                        'players' => [
                            'jg' => [1, 4],
                            'kc' => [2, 4],
                            'md' => [3, 4],
                            'eg' => [4, 4],
                        ]
                    ],
                    [
                        'game' => 'tikal',
                        'players' => [
                            'ml' => [1, 4],
                            'mk' => [2, 4],
                            'ab' => [3, 4],
                            'tk' => [4, 4],
                        ]
                    ],
                ]
            ],
        ];
        foreach ($meetings as $row) {
            $meeting = new Meeting();
            $meeting
                ->setSeason($season)
                ->setDate(new \DateTime($row[0]));
            $em->persist($meeting);

            foreach ($row['bouts'] as $boutData) {
                $game = $this->getReference('game-'.$boutData['game']);
                $bout = new Bout();
                $bout
                    ->setMeeting($meeting)
                    ->setGame($game)
                    ->setMaxPlayers($game->getMaxPlayers());
                $em->persist($bout);

                foreach ($boutData['players'] as $playerId => $playerData) {
                    $meetingUser = new MeetingUser();
                    $meetingUser
                        ->setMeeting($meeting)
                        ->setUser($this->getReference('user-'.$playerId))
                        ->setBout($bout)
                        ->setPlace($playerData[0]);
                    $em->persist($meetingUser);
                }
            }

            $em->flush();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 50;
    }
}
