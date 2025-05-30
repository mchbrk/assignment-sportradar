<?php
declare(strict_types=1);

namespace App\Contracts;

interface IBoard
{
    public function startGame(string $home, string $away): int;
    public function finishGame(int $id): void;
    public function updateGame(int $id, int $home = 0, int $away = 0): void;

    public function summary(): array;
}
