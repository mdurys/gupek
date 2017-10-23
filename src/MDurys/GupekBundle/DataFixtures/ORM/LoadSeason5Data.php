<?php

namespace MDurys\GupekBundle\DataFixtures\ORM;

class LoadSeason5Data extends SeasonFixture
{
    /**
     * @return array
     */
    protected function getMeetingData()
    {
        return
        [
            [
                'date' => '2014-09-04 19:30:00',
                'bouts' => [
                    [
                        'game' => 'imperial2030',
                        'players' => [
                            'janekg' => [1, 4],
                            'krzysiekc' => [2, 4],
                            'michald' => [3, 4],
                            'erykg' => [4, 4],
                        ]
                    ],
                    [
                        'game' => 'tikal',
                        'players' => [
                            'marekl' => [1, 4],
                            'maciekk' => [2, 4],
                            'adamb' => [3, 4],
                            'tomekk' => [4, 4],
                        ]
                    ],
                    [
                        'game' => 'finca',
                        'players' => [
                            'tomekp' => [1, 4],
                            'jarekb' => [2, 4],
                            'szymonh' => [3, 4],
                            'rafalj' => [4, 4],
                        ]
                    ],
                ]
            ],
            [
                'date' => '2014-09-11 19:30:00',
                'bouts' => [
                    [
                        'game' => 'hacienda',
                        'players' => [
                            'krzysiekc' => [1, 5],
                            'janekg' => [2, 5],
                            'tomekk' => [3, 5],
                            'erykg' => [4, 5],
                            'michald' => [5, 4],
                        ]
                    ],
                    [
                        'game' => 'navigator',
                        'players' => [
                            'maciekk' => [1, 4],
                            'jakubd' => [2, 4],
                            'jarekb' => [3, 4],
                            'adamb' => [4, 4],
                            'andrzejl' => [5, 4],
                        ]
                    ],
                ]
            ],
            [
                'date' => '2014-09-18 19:30:00',
                'bouts' => [
                    [
                        'game' => 'wysokie_napiecie',
                        'players' => [
                            'michald' => [1, 5],
                            'szymonh' => [2, 5],
                            'rafalj' => [3, 5],
                            'jarekb' => [4, 5],
                            'janekg' => [5, 4],
                        ]
                    ],
                ]
            ],
            [
                'date' => '2014-10-09 19:30:00',
                'bouts' => [
                    [
                        'game' => 'pokolenia',
                        'players' => [
                            'maciekk' => [1, 5],
                            'michald' => [2, 5],
                            'macieknk' => [3, 5],
                        ]
                    ],
                    [
                        'game' => 'pokolenia',
                        'players' => [
                            'tomekp' => [1, 5],
                            'krzysiekc' => [2, 5],
                            'adamb' => [3, 5],
                        ]
                    ],
                ]
            ],
            [
                'date' => '2014-10-16 19:30:00',
                'bouts' => [
                    [
                        'game' => 'waterdeep',
                        'players' => [
                            'erykg' => [1, 5],
                            'macieknk' => [2, 5],
                            'michald' => [3, 5],
                        ]
                    ],
                ]
            ],
            [
                'date' => '2014-11-13 19:30:00',
                'bouts' => [
                    [
                        'game' => 'keyflower',
                        'players' => [
                            'michald' => [1, 5],
                            'tomekk' => [2, 5],
                            'macieknk' => [2, 5],
                            'tomekp' => [4, 5],
                            'rafalj' => [5, 5],
                            'andrzejl' => [6, 5],
                        ]
                    ],
                ]
            ],
            [
                'date' => '2014-11-20 19:30:00',
                'bouts' => [
                    [
                        'game' => 'rheinlander',
                        // @todo check stats, 5 players?
                        'players' => [
                            'jarekb' => [1, 5],
                            'janekg' => [2, 5],
                            'tomekp' => [3, 5],
                            'szymonh' => [4, 5],
                        ]
                    ],
                    [
                        'game' => 'rheinlander',
                        'players' => [
                            'janekg' => [1, 5],
                            'szymonh' => [2, 5],
                            'jarekb' => [3, 5],
                            'macieknk' => [4, 5],
                        ]
                    ],
                    [
                        'game' => 'mumia',
                        'players' => [
                            'michald' => [1, 5],
                            'andrzejl' => [2, 5],
                            'erykg' => [3, 5],
                            'maciekd' => [3, 5],
                            'jakubd' => [5, 5],
                            'tomekk' => [5, 5],
                        ]
                    ],
                ]
            ],
            [
                'date' => '2014-12-04 19:30:00',
                'bouts' => [
                    [
                        'game' => 'atak_zombie',
                        'players' => [
                            'maciekk' => [1, 5],
                            'michald' => [2, 4],
                            'tomekk' => [3, 4],
                            'adamb' => [4, 4],
                        ]
                    ],
                    [
                        'game' => 'szogun',
                        'players' => [
                            'janekg' => [1, 5],
                            'andrzejl' => [2, 5],
                            'rafalj' => [3, 5],
                            'szymonh' => [4, 5],
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
        return 50;
    }
}
