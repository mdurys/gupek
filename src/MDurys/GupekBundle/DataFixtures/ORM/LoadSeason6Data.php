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
                '2016-01-14 19:30:00',
                'bouts' => [
                    [
                        'game' => 'antarctica',
                        'players' => [
                            'mk' => [1, 5],
                            'sh' => [2, 4],
                            'tk' => [3, 4],
                            'md' => [4, 5],
                        ]
                    ],
                    [
                        'game' => 'evolution',
                        'players' => [
                            'kc' => [1, 5],
                            'jd2' => [2, 5],
                            'eg' => [3, 5],
                            'md2' => [4, 5],
                            'mn' => [5, 5],
                        ]
                    ],
                ]
            ],
            [
                '2016-01-21 19:30:00',
                'bouts' => [
                    [
                        'game' => 'gaucho',
                        'players' => [
                            'sh' => [1, 4],
                            'md' => [2, 4],
                            'tk' => [3, 4],
                            'kc' => [4, 4],
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
