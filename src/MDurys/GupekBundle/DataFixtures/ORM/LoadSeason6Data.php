<?php

namespace MDurys\GupekBundle\DataFixtures\ORM;

class LoadSeason6Data extends SeasonFixture
{
    /**
     * @return array
     */
    protected function getMeetingData()
    {
        return
        [
            [
                'date' => '2016-01-14 19:30:00',
                'bouts' => [
                    [
                        'game' => 'antarctica',
                        'players' => [
                            'maciekk' => [1, 5],
                            'szymonh' => [2, 4],
                            'tomekk' => [3, 4],
                            'michald' => [4, 5],
                        ]
                    ],
                    [
                        'game' => 'evolution',
                        'players' => [
                            'krzysiekc' => [1, 5],
                            'jacekd' => [2, 5],
                            'erykg' => [3, 5],
                            'maciekd' => [4, 5],
                            'macieknk' => [5, 5],
                        ]
                    ],
                ]
            ],
            [
                'date' => '2016-01-21 19:30:00',
                'bouts' => [
                    [
                        'game' => 'gaucho',
                        'players' => [
                            'szymonh' => [1, 4],
                            'michald' => [2, 4],
                            'tomekk' => [3, 4],
                            'krzysiekc' => [4, 4],
                        ]
                    ],
                ]
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 60;
    }
}
