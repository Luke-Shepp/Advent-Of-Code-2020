<?php
/*
 * https://adventofcode.com/2020/day/3
 *
 * "You make a map (your puzzle input) of the open squares (.) and
 * trees (#) you can see. Starting at the top-left corner of your
 * map and following a slope of right 3 and down 1, how many trees
 * would you encounter?"
 */

$rows = explode("\n", file_get_contents('input.txt'));

$map = [];
$position = [0, 0]; // row, col

foreach ($rows as $row) {
    $map[] = str_split($row);
}

$trees = 0;

while ($position[0] < count($map)) {
    /*
     * "These aren't the only trees, though; due to something you read about
     * once involving arboreal genetics and biome stability, the same pattern repeats
     * to the right many times"
     */
    if ($map[$position[0]][$position[1] % count($map[$position[0]])] == "#") {
        $trees++;
    }

    $position[0] += 1;
    $position[1] += 3;
}

echo "Trees: " . $trees . "\n";