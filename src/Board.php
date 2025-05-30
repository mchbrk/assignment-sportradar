<?php
declare(strict_types=1);

namespace App;

use App\Contracts\IBoard;

class Board implements IBoard
{
    protected array $games = [];

    public function startGame(string $home = 'Home', string $away = 'Away'): int
    {
        return $this->addGame(new Game($home, $away));
    }

    public function finishGame(int $id): void
    {
        $this->getGame($id)->finish();
    }

    public function updateGame(int $id, int $home = 0, int $away = 0): void
    {
        $this->getGame($id)->update($home, $away);
    }

    public function summary(): array
    {
        $results = $this->getFinishedGames();
        $lookup = $this->prepareLookup($results);

        uasort($lookup, function ($a, $b) {
            if ($a['total'] === $b['total']) {
                return $b['index'] <=> $a['index'];
            }
            return $b['total'] <=> $a['total'];
        });

        return array_values(array_map(function ($result) {
            return $this->games[$result['index']];
        }, $lookup));
    }

    private function getFinishedGames(): array
    {
        return array_filter($this->games, static function (Game $game) {
            return $game->isFinished() === false;
        });
    }

    private function addGame(Game $game): int
    {
        $this->games[] = $game;
        return array_key_last($this->games);
    }

    private function getGame(int $id): Game
    {
        if (array_key_exists($id, $this->games)) {
            return $this->games[$id];
        }

        throw new \RuntimeException('Game not found.');
    }

    private function prepareLookup(array $results): array
    {
        return array_map(function (Game $game) {
            return [
                'total' => $game->getHome()->score + $game->getAway()->score,
                'index' => array_search($game, $this->games, true),
            ];
        }, $results);
    }

    public function __toString(): string
    {
        $summary = $this->summary();

        if (empty($summary)) {
            return 'No games found.';
        }

        return implode("\n", $summary);
    }
}
