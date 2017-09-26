<?php

namespace MDurys\GupekBundle\DataFixtures\ORM;

class LoadSeason4Data extends SeasonFixture
{
    /**
     * @return array
     */
    protected function getMeetingData()
    {
        return
            [
                [
                    '2013-09-05 19:30:00',
                    'bouts' => [
                        [
                            'game' => 'imie_rozy',
                            'players' => [
                                'jb' => [1, 4],
                                'ml' => [2, 4],
                                'jd2' => [3, 4],
                                'ab' => [4, 4],
                            ]
                        ],
                        [
                            'game' => 'aquileia',
                            'players' => [
                                'tp' => [1, 4],
                                'jg' => [2, 4],
                                'tk' => [3, 4],
                                'eg' => [4, 4],
                                'kc' => [5, 4],
                            ]
                        ],
                    ]
                ],
                [
                    '2013-09-12 19:30:00',
                    'bouts' => [
                        [
                            'game' => 'notre_dame',
                            'players' => [
                                'eg' => [1, 4],
                                'jg' => [2, 4],
                                'tk' => [3, 4],
                                'ab' => [4, 4],
                            ]
                        ],
                        [
                            'game' => 'aquileia',
                            'players' => [
                                'md' => [1, 4],
                                'jd2' => [2, 4],
                                'tp' => [3, 4],
                                'mk' => [4, 4],
                                'rj' => [5, 4],
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
        return 40;
    }
}
