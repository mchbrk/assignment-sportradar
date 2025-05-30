<?php
declare(strict_types=1);

namespace App;

use App\Contracts\IGame;

class Game implements IGame
{
    protected Team $home;
    protected Team $away;
    protected bool $finished = false;

    protected int $timestamp = 0;

    public function __construct(string $home, string $away)
    {
        $this->home = new Team($home);
        $this->away = new Team($away);
    }

    public function update(int $home = 0, int $away = 0): void
    {
        if ($this->finished) {
            throw new \RuntimeException('Game has already finished.');
        }

        if ($home >= $this->home->score) {
            $this->home->score = $home;
        } else {
            throw new \RuntimeException("Home has already {$this->home->score} points.");
        }

        if ($away >= $this->away->score) {
            $this->away->score = $away;
        } else {
            throw new \RuntimeException("Away has already {$this->home} points.");
        }
    }

    public function isFinished(): bool
    {
        return $this->finished;
    }

    public function finish(): void
    {
        if ($this->finished) {
            throw new \RuntimeException('Game has already finished.');
        }

        $this->finished = true;
    }

    public function getHome(): Team
    {
        return $this->home;
    }

    public function getAway(): Team
    {
        return $this->away;
    }

    public function __toString(): string
    {
        return "{$this->home->name} {$this->home->score} : {$this->away->score} {$this->away->name}";
    }
}
