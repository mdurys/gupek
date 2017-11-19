<?php

declare(strict_types=1);

namespace MDurys\GupekBundle\DataFixtures\ORM;

class LoadSeason7Data extends SeasonFixture
{
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
                            'rafalj' => [1, 3],
                            'tomekk' => [2, 4],
                            'erykg' => [3, 4],
                            'michald' => [4, 5],
                        ],
                    ],
                    [
                        'game' => 'evolution',
                        'players' => [
                            'adamb' => [1, 4],  // @todo
                            'macieknk' => [2, 4],  // @todo
                            'krzysiekc' => [2, 4],  // @todo
                            'szymonh' => [2, 4],  // @todo
                            'jarekb' => [2, 4],  // @todo
                        ],
                    ],
                ],
            ],
            [
                'date' => '2017-09-28 19:00:00',
                'bouts' => [
                    [
                        'game' => 'formula_d',
                        'players' => [
                            'andrzejl' => [1, 4],
                            'tomekk' => [2, 4],
                            'adamb' => [3, 4],
                            'jarekb' => [4, 4],
                            'rafalj' => [5, 3],
                            'szymonh' => [6, 4],
                            'michald' => [7, 5],
                        ],
                    ],
                ],
            ],
            [
                'date' => '2017-10-05 19:00:00',
                'bouts' => [
                    [
                        'game' => 'edo',  // @todo Edo is for 4 players, expansion was used?
                        'players' => [
                            'maciekd' => [1, 4],
                            'krzysiekc' => [2, 4],
                            'rafalj' => [3, 4],
                            'tomekk' => [4, 5],
                            'jarekb' => [5, 3],
                        ],
                    ],
                    [
                        'game' => 'na_chwale_rzymu',
                        'players' => [
                            'jacekd' => [1, 4],
                            'szymonh' => [1, 4],
                            'macieknk' => [3, 3],
                            'michald' => [4, 4],
                            'erykg' => [5, 4],
                        ],
                    ],
                    [
                        'game' => 'na_chwale_rzymu',
                        'players' => [
                            'erykg' => [1, 4],
                            'jacekd' => [1, 4],
                            'macieknk' => [3, 3],
                            'michald' => [4, 4],
                            'szymonh' => [5, 3],
                        ],
                    ],
                ],
            ],
            // meeting 2017-10-12 was cancelled
            [
                'date' => '2017-10-19 19:00:00',
                'bouts' => [
                    [
                        'game' => 'java',
                        'players' => [
                            'tomekk' => [1, 4],
                            'krzysiekc' => [2, 4],
                            'macieknk' => [3, 4],
                            'michald' => [4, 5],
                        ],
                    ],
                    [
                        'game' => 'rialto',
                        'players' => [
                            'rafalj' => [1, 4],
                            'janekg' => [2, 4],
                            'travis' => [3, 4],
                        ],
                    ],
                    [
                        'game' => 'rialto',
                        'players' => [
                            'janekg' => [1, 4],
                            'travis' => [2, 4],
                            'rafalj' => [3, 4],
                        ],
                    ],
                ],
            ],
            [
                'date' => '2017-11-16 19:00:00',
                'bouts' => [
                    [
                        'game' => 'condottiere',
                        'players' => [
                            'erykg' => [1, 5],
                            'michald' => [2, 5],
                            'tomekk' => [3, 5],
                            'krzysiekc' => [4, 4],
                            'macieknk' => [5, 4],
                            'adamb' => [5, 5],
                        ],
                    ],
                    [
                        'game' => 'condottiere',
                        'players' => [
                            'michald' => [1, 5], // -1 dignity
                            'krzysiekc' => [2, 4],
                            'erykg' => [3, 5],
                            'tomekk' => [3, 5], // -1 dignity
                            'adamb' => [3, 5],
                            'macieknk' => [6, 5],
                        ],
                    ],
                ],
            ],
        ];
    }
}