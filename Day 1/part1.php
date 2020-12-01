<?php
/*
 * https://adventofcode.com/2020/day/1
 *
 * "Specifically, they need you to find the two entries that sum
 * to 2020 and then multiply those two numbers together."
 */

$entries = explode("\n", file_get_contents('input.txt'));

rsort($entries);

foreach ($entries as $i => $first) {
    foreach (array_slice($entries, $i) as $second) {
        if ($first + $second == 2020) {
            echo "Answer: " . $first * $second . "\n";
            break 2;
        }
    }
}