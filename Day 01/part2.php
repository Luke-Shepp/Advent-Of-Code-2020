<?php
/*
 * https://adventofcode.com/2020/day/1
 *
 * "They offer you a second one if you can find *three* numbers
 * in your expense report that meet the same criteria."
 */

$entries = explode("\n", file_get_contents('input.txt'));

rsort($entries);

foreach ($entries as $i => $first) {
    foreach (array_slice($entries, $i) as $j => $second) {
        foreach (array_slice($entries, $j) as $third) {
            if ($first + $second + $third == 2020) {
                echo "Answer: " . $first * $second * $third . "\n";
                break 3;
            }
        }
    }
}