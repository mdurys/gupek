<?php

namespace MDurys\GupekBundle\DataFixtures\ORM;

use MDurys\GupekBundle\Entity\BoutUser;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MDurys\GupekBundle\Entity\Season;
use MDurys\GupekBundle\Entity\Bout;
use MDurys\GupekBundle\Entity\Meeting;

abstract class SeasonFixture extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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

        foreach ($this->getMeetingData() as $row) {
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
                    ->setMaxPlayers($game->getMaxPlayers())
                    ->setStatus(Bout::STATUS_FINISHED);
                $em->persist($bout);

//                $boutLogic->calculateScores($bout);

                foreach ($boutData['players'] as $playerId => $playerData) {
                    $boutUser = new BoutUser();
                    $boutUser
                        ->setBout($bout)
                        ->setUser($this->getReference('user-' . $playerId))
                        ->setPlace($playerData[0]);
                    $em->persist($boutUser);
                }
            }

            $em->flush();
        }
    }

    /**
     * @return array Meeting data
     */
    abstract protected function getMeetingData();
}
