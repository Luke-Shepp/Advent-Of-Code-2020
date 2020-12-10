<?php
/**
 * https://adventofcode.com/2020/day/9
 *
 * "The final step in breaking the XMAS encryption relies on the invalid
 * number you just found: you must find a contiguous set of at least two
 * numbers in your list which sum to the invalid number from step 1.
 *
 * To find the encryption weakness, add together the smallest and largest
 * number in this contiguous range."
 */

// Functions are required in both parts today, so are split into a shared include.
include('inc.php');

$numbers = getInput();
$target  = getInvalidNumber();

for ($i = 0; $i < count($numbers); $i++) {
    $sum = $numbers[$i];

    // Search forward until either the sum is more than the target, or we've found a set of
    // numbers that equal the target.
    for ($j = $i + 1; $j < count($numbers); $j++) {
        $sum += $numbers[$j];

        if ($sum == $target) {
            $range = array_slice($numbers, $i, $j-$i);
            echo "Answer: " . (min($range) + max($range)) . "\n";
            break 2;
        } elseif ($sum > $target) {
            continue 2;
        }
    }
}