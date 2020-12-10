<?php
/*
 * https://adventofcode.com/2020/day/3
 *
 * "Determine the number of trees you would encounter if, for each of the
 * following slopes, you start at the top-left corner and traverse the map
 * all the way to the bottom.
 *
 * What do you get if you multiply together the number of trees encountered
 * on each of the listed slopes?"
 */

$rows = explode("\n", file_get_contents('input.txt'));

$map = [];

$steps = [
    [1, 1], // Right 1, down 1.
    [1, 3], // Right 3, down 1.
    [1, 5], // Right 5, down 1.
    [1, 7], // Right 7, down 1.
    [2, 1], // Right 1, down 2.
];

foreach ($rows as $row) {
    $map[] = str_split($row);
}

$trees = [];

foreach ($steps as $i => $step) {
    $position = [0, 0]; // row, col

    while ($position[0] < count($map)) {
        /*
         * "These aren't the only trees, though; due to something you read about
         * once involving arboreal genetics and biome stability, the same pattern repeats
         * to the right many times"
         */
        if ($map[$position[0]][$position[1] % count($map[$position[0]])] == "#") {
            $trees[$i] = ($trees[$i] ?? 0) + 1;
        }

        $position[0] += $step[0];
        $position[1] += $step[1];
    }
}

echo "Answer: " . array_product($trees) . "\n";