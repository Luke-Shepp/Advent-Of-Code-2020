<?php
/**
 * https://adventofcode.com/2020/day/15
 *
 * "Impressed, the Elves issue you a challenge: determine the 30000000th number spoken."
 */

/**
 * This is a modification of part 1 to make it more efficient. Instead of searching
 * for occourances of an array value each loop iteration, keep track of where the
 * last occourance of a number was to avoid costly array processing 30 million times.
*/

// Take it all!
ini_set('memory_limit', '-1');

$numbers = explode(',', file_get_contents('input.txt'));

// [number => last occourance position]
$map = array_combine($numbers, range(1, count($numbers)));

$iter = count($numbers);
$last = end($numbers);

while ($iter < 30_000_000) {
    $lastOccourance = $map[$last] ?? $iter;
    $map[$last] = $iter;
    $last = $iter - $lastOccourance;

    $iter++;
}

echo "Answer: " . $last . "\n";