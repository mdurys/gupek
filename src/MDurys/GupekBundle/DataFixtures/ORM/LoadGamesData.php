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
            'apacze' => ['Apacze i Komancze', 2, 4],
            'basketboss' => ['BasketBoss', 2, 5],
            'carson' => ['Carson City', 2, 5],
            'catan' => ['Osadnicy z Catanu', 2, 4],
            'finca' => ['Finca', 2, 4],
            'hacienda' => ['Hacienda', 2, 5],
            'imperial2030' => ['Imperial 2030', 2, 6],
            'keyflower' => ['Keyflower', 2, 6],
            'kolejka' => ['Kolejka', 2, 5],
            'merchants' => ['Merchants of the Middle Ages', 2, 4],
            'mumia' => ['Mumia — Wyścig w bandażach', 2, 6],
            'narodziny_imperium' => ['Osadnicy: Narodziny Imperium', 2, 4],
            'navigator' => ['Navigator', 2, 5],
            'pokolenia' => ['Pokolenia', 2, 4],
            'posrod_gwiazd' => ['Pośród gwiazd', 2, 4],
            'rheinlander' => ['Rheinländer', 3, 5],
            'samuraj' => ['Samuraj', 2, 4],
            'terra_mystica' => ['Terra Mystica', 2, 5],
            'tikal' => ['Tikal', 2, 4],
            'trajan' => ['Trajan', 2, 4],
            'waterdeep' => ['Lords of Waterdeep', 2, 5],
            'wysokie_napiecie' => ['Wysokie napięcie', 2, 6],
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
        return 2;
    }
}
