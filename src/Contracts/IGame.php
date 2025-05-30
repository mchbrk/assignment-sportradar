<?php

namespace App\Contracts;

interface IGame
{
    public function update(int $home = 0, int $away = 0): void;

    public function finish(): void;
}
