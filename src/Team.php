<?php
declare(strict_types=1);

namespace App;

use App\Contracts\ITeam;

class Team implements ITeam
{
    public function __construct(public readonly string $name, public int $score = 0)
    {
    }
}
