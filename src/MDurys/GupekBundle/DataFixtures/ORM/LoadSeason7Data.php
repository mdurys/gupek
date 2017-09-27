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
        ];
    }
}