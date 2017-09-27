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
                'date' => '2014-09-11 19:30:00',
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
                'date' => '2014-09-18 19:30:00',
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
                'date' => '2014-10-09 19:30:00',
                'bouts' => [
                    [
                        'game' => 'pokolenia',
                        'players' => [
                            'mk' => [1, 5],
                            'md' => [2, 5],
                            'mn' => [3, 5],
                        ]
                    ],
                    [
                        'game' => 'pokolenia',
                        'players' => [
                            'tp' => [1, 5],
                            'kc' => [2, 5],
                            'ab' => [3, 5],
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
                            'eg' => [1, 5],
                            'mn' => [2, 5],
                            'md' => [3, 5],
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
            [
                'date' => '2014-11-20 19:30:00',
                'bouts' => [
                    [
                        'game' => 'rheinlander',
                        // @todo check stats, 5 players?
                        'players' => [
                            'jb' => [1, 5],
                            'jg' => [2, 5],
                            'tp' => [3, 5],
                            'sh' => [4, 5],
                        ]
                    ],
                    [
                        'game' => 'rheinlander',
                        'players' => [
                            'jg' => [1, 5],
                            'sh' => [2, 5],
                            'jb' => [3, 5],
                            'mn' => [4, 5],
                        ]
                    ],
                    [
                        'game' => 'mumia',
                        'players' => [
                            'md' => [1, 5],
                            'al' => [2, 5],
                            'eg' => [3, 5],
                            'md2' => [3, 5],
                            'jd' => [5, 5],
                            'tk' => [5, 5],
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
                            'mk' => [1, 5],
                            'md' => [2, 4],
                            'tk' => [3, 4],
                            'ab' => [4, 4],
                        ]
                    ],
                    [
                        'game' => 'szogun',
                        'players' => [
                            'jg' => [1, 5],
                            'al' => [2, 5],
                            'rj' => [3, 5],
                            'sh' => [4, 5],
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
