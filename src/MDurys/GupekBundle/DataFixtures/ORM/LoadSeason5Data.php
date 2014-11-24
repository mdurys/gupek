<?php

namespace MDurys\GupekBundle\DataFixtures\ORM;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MDurys\GupekBundle\Entity\Season;
use MDurys\GupekBundle\Entity\Bout;
use MDurys\GupekBundle\Entity\Meeting;
use MDurys\GupekBundle\Entity\MeetingUser;

class LoadSeason5Data extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $em)
    {
        $season = new Season();
        $em->persist($season);
        $em->flush();

        $boutLogic = $this->container->get('gupek.logic.bout');

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
                    [
                        'game' => 'finca',
                        'players' => [
                            'tp' => [1, 4],
                            'jb' => [2, 4],
                            'sh' => [3, 4],
                            'rj' => [4, 4],
                        ]
                    ],
                ]
            ],
            [
                '2014-09-11 19:30:00',
                'bouts' => [
                    [
                        'game' => 'hacienda',
                        'players' => [
                            'kc' => [1, 5],
                            'jg' => [2, 5],
                            'tk' => [3, 5],
                            'eg' => [4, 5],
                            'md' => [5, 4],
                        ]
                    ],
                    [
                        'game' => 'navigator',
                        'players' => [
                            'mk' => [1, 4],
                            'jd' => [2, 4],
                            'jb' => [3, 4],
                            'ab' => [4, 4],
                            'al' => [5, 4],
                        ]
                    ],
                ]
            ],
            [
                '2014-09-18 19:30:00',
                'bouts' => [
                    [
                        'game' => 'wysokie_napiecie',
                        'players' => [
                            'md' => [1, 5],
                            'sh' => [2, 5],
                            'rj' => [3, 5],
                            'jb' => [4, 5],
                            'jg' => [5, 4],
                        ]
                    ],
                ]
            ],
            [
                '2014-10-16 19:30:00',
                'bouts' => [
                    [
                        'game' => 'waterdeep',
                        'players' => [
                            'eg' => [1, 5],
                            'mn' => [2, 5],
                            'md' => [3, 5],
                        ]
                    ],
                ]
            ],
            [
                '2014-11-13 19:30:00',
                'bouts' => [
                    [
                        'game' => 'keyflower',
                        'players' => [
                            'md' => [1, 5],
                            'tk' => [2, 5],
                            'mn' => [2, 5],
                            'tp' => [4, 5],
                            'rj' => [5, 5],
                            'al' => [6, 5],
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
                    $bout->addMeetingUser($meetingUser);
                }

                $boutLogic->calculateScores($bout);
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
