<?php

declare(strict_types=1);

namespace MDurys\GupekBundle\Tests\Domain\Meeting;

use MDurys\GupekBundle\Domain\Meeting\BoutInterface;
use MDurys\GupekBundle\Domain\Meeting\BoutPlayerInterface;
use MDurys\GupekBundle\Domain\Meeting\BoutService;
use PHPUnit\Framework\TestCase;


class BoutServiceTest extends TestCase
{
    /**
     * @var BoutService
     */
    private $boutService;

    /**
     * @var BoutInterface
     */
    private $bout;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->boutService = new BoutService();
        $this->bout = $this->createMock(BoutInterface::class);
    }

    /**
     * @param array $places
     *
     * @dataProvider validDataProvider
     */
    public function testAssignValidPlaces(array $places)
    {
        $this->givenBoutWithPlayers(4);

        $results = $this->boutService->assignPlaces($this->bout, $places);

        $this->assertCount(4, $results);
    }

    /**
     * @param array $places
     *
     * @expectedException \RuntimeException
     * @dataProvider invalidDataProvider
     */
    public function testAssignInvalidPlaces(array $places)
    {
        $this->givenBoutWithPlayers(4);

        $this->boutService->assignPlaces($this->bout, $places);
    }

    public function validDataProvider()
    {
        return [
            'normal' => [[1 => 1, 2 => 2, 3 => 3, 4 => 4]],
            'draw 1st' => [[1 => 1, 2 => 1, 3 => 3, 4 => 4]],
            'triple draw 1st' => [[1 => 1, 2 => 1, 3 => 1, 4 => 4]],
            'only 1st' => [[1 => 1, 2 => 1, 3 => 1, 4 => 1]],
            'draw 2nd' => [[1 => 1, 2 => 2, 3 => 2, 4 => 4]],
            'unordered' => [[1 => 3, 2 => 1, 3 => 4, 4 => 2]],
        ];
    }

    public function invalidDataProvider()
    {
        return [
            'too few places' => [[1 => 1, 2 => 2, 3 => 3]],
            'too many places' => [[1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5]],
            'player not participating' => [[5 => 1, 2 => 2, 3 => 3, 4 => 4]],
            'place out of range' => [[1 => 9, 2 => 2, 3 => 3, 4 => 4]],
            'negative place' => [[1 => -3, 2 => 2, 3 => 3, 4 => 4]],
            '0 place' => [[1 => 0, 2 => 2, 3 => 3, 4 => 4]],
            'illegal 2nd place' => [[1 => 1, 2 => 1, 3 => 2, 4 => 3]],
            'only 2nd' => [[1 => 2, 2 => 2, 3 => 2, 4 => 2]],
        ];
    }

    private function givenBoutWithPlayers(int $noPlayers)
    {
        $players = [];

        for ($i = 1; $i <= $noPlayers; $i++) {
            $player = $this->createMock(BoutPlayerInterface::class);
            $player->method('getPlayerId')->willReturn($i);
            $player->method('setPlace')->with($this->anything())->willReturn($player);
            $players[] = $player;
        }

        $this->bout->method('getPlayers')->willReturn($players);
    }
}