<?php

namespace MDurys\GupekBundle\DataFixtures\ORM;

class LoadSeason6Data extends SeasonFixture
{
    /**
     * @return array
     */
    protected function getMeetingData()
    {
        return [
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
