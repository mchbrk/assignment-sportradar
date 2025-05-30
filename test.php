<?php

use App\Board;

require __DIR__ . '/vendor/autoload.php';

echo "Score board";
echo "\n";
$board = new Board();
$id = $board->startGame('A', 'B');
$board->updateGame($id, 1, 0);
echo (string) $board;
echo "\n";
$board->updateGame($id, 1, 1);
$board->updateGame($id, 1, 2);
echo (string) $board;
echo "\n";
$board->finishGame($id);
echo (string) $board;
echo "\n";
