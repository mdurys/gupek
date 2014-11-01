<?php

namespace MDurys\GupekBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MDurys\GupekBundle\Entity\Game;

class LoadGamesData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $em)
    {
        $data = [
            'waterdeep' => ['Lords of Waterdeep', 2, 5],
            'catan' => ['Osadnicy z Catanu', 2, 4],
        ];

        foreach ($data as $id => $row) {
            $game = new Game();
            $game
                ->setName($row[0])
                ->setMinPlayers($row[1])
                ->setMaxPlayers($row[2]);
            $em->persist($game);
            $em->flush();
            $this->addReference('game-'.$id, $game);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
