<?php

declare(strict_types=1);

namespace MDurys\GupekBundle\DataFixtures\ORM;

use MDurys\GupekBundle\Entity\Bout;
use MDurys\GupekBundle\Entity\BoutUser;
use MDurys\GupekBundle\Entity\Game;
use MDurys\GupekBundle\Entity\Meeting;
use MDurys\GupekBundle\Entity\Season;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSeason7Data extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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

        foreach ($this->getMeetingData() as $meetingData) {
            $meeting = new Meeting();
            $meeting
                ->setSeason($season)
                ->setDate(new \DateTime($meetingData['date']));
            $em->persist($meeting);

            foreach ($meetingData['bouts'] as $boutData) {
                /** @var Game $game */
                $game = $this->getReference('game-' . $boutData['game']);
                $bout = new Bout();
                $bout
                    ->setMeeting($meeting)
                    ->setMaxPlayers($game->getMaxPlayers())
                    ->setGame($game)
                    ->setStatus(Bout::STATUS_FINISHED);
                $em->persist($bout);

                foreach ($boutData['players'] as $playerId => $place) {
                    $boutUser = new BoutUser();
                    $boutUser
                        ->setBout($bout)
                        ->setUser($this->getReference('user-' . $playerId))
                        ->setPlace($place);
                    $em->persist($boutUser);
                }
            }
        }
        $em->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 70;
    }

    /**
     * @return array
     */
    protected function getMeetingData(): array
    {
        return [
            [
                'date' => '2017-09-21 19:00:00',
                'bouts' => [
                    [
                        'game' => 'yamatai',
                        'players' => [
                            'rj' => 1,
                            'tk' => 2,
                            'eg' => 3,
                            'md' => 4,
                        ],
                    ],
                    [
                        'game' => 'evolution',
                        'players' => [
                            'ab' => 1,
                            'mk' => 2,  // @todo
                            'kc' => 2,  // @todo
                            'sh' => 2,  // @todo
                            'jb' => 2,  // @todo
                        ],
                    ],
                ],
            ],
        ];
    }
}