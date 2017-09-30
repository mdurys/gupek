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
            'antarctica' => ['Antarctica', 2, 4],
            'antike' => ['Antike', 2, 6],
            'apacze' => ['Apacze i Komancze', 2, 4],
            'aquileia' => ['Aquileia', 2, 5],
            'atak_zombie' => ['Atak zombie', 2, 4],
            'basketboss' => ['BasketBoss', 2, 5],
            'carson' => ['Carson City', 2, 5],
            'casador' => ['El Casador', 2, 5],  // @todo check this
            'catan' => ['Osadnicy z Catanu', 2, 4],
            'colt' => ['Colt Express', 2, 6],
            'concordia' => ['Concordia', 2, 5],
            'drake' => ['Francis Drake', 3, 5],
            'el_grande' => ['El Grande', 2, 5],
            'evolution' => ['Evolution', 2, 6],
            'finca' => ['Finca', 2, 4],
            'formula_d' => ['Formula D', 2, 10],
            'gaucho' => ['El Gaucho', 2, 4],
            'hacienda' => ['Hacienda', 2, 5],
            'hansa' => ['Hansa Teutonica', 2, 5],
            'heart_of_africa' => ['Heart of Africa', 2, 5],
            'hollywood' => ['Hollywood', 2, 6],
            'imie_rozy' => ['Imię Róży', 2, 5],
            'imperial2030' => ['Imperial 2030', 2, 6],
            'keyflower' => ['Keyflower', 2, 6],
            'kolejka' => ['Kolejka', 2, 5],
            'merchants' => ['Merchants of the Middle Ages', 2, 4],
            'mumia' => ['Mumia — Wyścig w bandażach', 2, 6],
            'narodziny_imperium' => ['Osadnicy: Narodziny Imperium', 2, 4],
            'navigator' => ['Navigator', 2, 5],
            'notre_dame' => ['Notre Dame', 2, 5],
            'planet_steam' => ['Planet Steam', 2, 5],
            'pokolenia' => ['Pokolenia', 2, 4],
            'posrod_gwiazd' => ['Pośród gwiazd', 2, 4],
            'rheinlander' => ['Rheinländer', 3, 5],
            'samuraj' => ['Samuraj', 2, 4],
            'splendor' => ['Splendor', 2, 4],
            'stone_age' => ['Stone Age', 2, 4],
            'szogun' => ['Szogun', 3, 5],
            'terra_mystica' => ['Terra Mystica', 2, 5],
            'tikal' => ['Tikal', 2, 4],
            'trajan' => ['Trajan', 2, 4],
            'tytus' => ['Tytus, Romek i A\'tomek', 2, 5],
            'waterdeep' => ['Lords of Waterdeep', 2, 5],
            'wysokie_napiecie' => ['Wysokie napięcie', 2, 6],
            'yamatai' => ['Yamataï', 2, 4],
        ];

        foreach ($data as $id => $row) {
            list($name, $minPlayers, $maxPlayers) = $row;
            $game = new Game();
            $game
                ->setName($name)
                ->setMinPlayers($minPlayers)
                ->setMaxPlayers($maxPlayers);
            $em->persist($game);
            $em->flush();
            $this->addReference('game-' . $id, $game);
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
