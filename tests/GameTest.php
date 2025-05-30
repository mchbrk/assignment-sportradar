<?php
declare(strict_types=1);

namespace Tests;

use App\Game;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Game::class)]
class GameTest extends TestCase
{
    private Game $game;

    protected function setUp(): void
    {
        parent::setUp();
        $this->game = new Game($this->faker->country, $this->faker->country);
    }

    public function testStart(): void
    {
        $this->assertEquals(0, $this->game->getHome()->score);
        $this->assertEquals(0, $this->game->getAway()->score);
    }

    public function testUpdate(): void
    {
        $home = $this->faker->numberBetween(1, 10);
        $away = $this->faker->numberBetween(1, 10);

        $this->game->update($home, $away);
        $this->assertEquals($home, $this->game->getHome()->score);
        $this->assertEquals($away, $this->game->getAway()->score);
    }
}
