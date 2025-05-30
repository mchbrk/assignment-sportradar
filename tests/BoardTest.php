<?php
declare(strict_types=1);

namespace Tests;

use App\Board;
use App\Game;
use App\Team;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Board::class)]
class BoardTest extends TestCase
{
    private Board $board;

    protected function setUp(): void
    {
        parent::setUp();
        $this->board = new Board();
    }

    public function testStart(): void
    {
        $summary = $this->board->summary();

        $this->assertIsArray($summary);
        $this->assertEmpty($summary);
    }

    public function testSummary(): void
    {
        $games = [
            ['Mexico', 'Canada', 0, 5, false],
            ['Spain', 'Brazil', 10, 2, false],
            ['Germany', 'France', 2, 2, false],
            ['Uruguay', 'Italy', 6, 6, false],
            ['Argentina', 'Australia', 3, 1, false],
        ];

        foreach ($games as $game) {
            $id = $this->createGame(new Team($game[0], $game[2]), new Team($game[1], $game[3]));
            if ($game[4] ?? false) {
                $this->board->finishGame($id);
            }
        }

        $expected = [
            ['Uruguay', 'Italy', 6, 6],
            ['Spain', 'Brazil', 10, 2],
            ['Mexico', 'Canada', 0, 5],
            ['Argentina', 'Australia', 3, 1],
            ['Germany', 'France', 2, 2],
        ];

        $summary = $this->board->summary();
        $this->assertIsArray($summary);
        $this->assertNotEmpty($summary);
        $this->assertCount(count($expected), $summary);

        foreach ($expected as $index => $game) {
            /** @var Game $element */
            $element = $summary[$index] ?? null;
            $this->assertEquals($element?->getHome()->name, $game[0]);
            $this->assertEquals($element?->getAway()->name, $game[1]);
            $this->assertEquals($element?->getHome()->score, $game[2]);
            $this->assertEquals($element?->getAway()->score, $game[3]);
        }
    }

    private function createGame(Team $home, Team $away): int
    {
        $id = $this->board->startGame($home->name, $away->name);
        $this->board->updateGame($id, $home->score, $away->score);
        return $id;
    }
}
