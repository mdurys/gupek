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
                            'rj' => [1, 3],
                            'tk' => [2, 4],
                            'eg' => [3, 4],
                            'md' => [4, 5],
                        ],
                    ],
                    [
                        'game' => 'evolution',
                        'players' => [
                            'ab' => [1, 4],  // @todo
                            'mk' => [2, 4],  // @todo
                            'kc' => [2, 4],  // @todo
                            'sh' => [2, 4],  // @todo
                            'jb' => [2, 4],  // @todo
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
                            'al' => [1, 4],
                            'tk' => [2, 4],
                            'ab' => [3, 4],
                            'jb' => [4, 4],
                            'rj' => [5, 3],
                            'sh' => [6, 4],
                            'md' => [7, 5],
                        ],
                    ],
                ],
            ],
            [
                'date' => '2017-10-05 19:00:00',
                'bouts' => [
//                    [
//                        'game' => 'edo',  // @todo Edo is for 4 players, expansion was used?
//                        'players' => [
//                            'md2' => [1, ?],
//                            'tk' => [?, ?],
//                            'rj' => [?, ?],
//                            'kc' => [?, ?],
//                            'jb' => [?, ?],
//                        ],
//                    ],
                    [
                        'game' => 'na_chwale_rzymu',
                        'players' => [
                            'jd2' => [1, 4],
                            'sh' => [1, 4],
                            'mn' => [3, 3],
                            'md' => [4, 4],
                            'eg' => [5, 4],
                        ],
                    ],
                    [
                        'game' => 'na_chwale_rzymu',
                        'players' => [
                            'eg' => [1, 4],
                            'jd2' => [1, 4],
                            'mn' => [3, 3],
                            'md' => [4, 4],
                            'sh' => [5, 3],
                        ],
                    ],
                ],
            ],
        ];
    }
}