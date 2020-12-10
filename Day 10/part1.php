<?php
/**
 * https://adventofcode.com/2020/day/10
 *
 * "Each of your joltage adapters is rated for a specific output joltage (your puzzle input).
 * Any given adapter can take an input 1, 2, or 3 jolts lower than its rating and still
 * produce its rated output joltage.
 *
 * In addition, your device has a built-in joltage adapter rated for 3 jolts higher than
 * the highest-rated adapter in your bag. (If your adapter list were 3, 9, and 6, your
 * device's built-in adapter would be rated for 12 jolts.)
 *
 * Treat the charging outlet near your seat as having an effective joltage rating of 0.
 *
 * If you use every adapter in your bag at once, what is the distribution of joltage
 * differences between the charging outlet, the adapters, and your device?
 *
 * What is the number of 1-jolt differences multiplied by the number of 3-jolt
 * differences?"
 */


/**
 * This challenge can be thought of in another way, making it a much simpler solution
 * than the question makes it out to be. The challenge hints that we must use numbers in
 * order if there are multiple within 3j of the previous number. This means we can simply
 * sort the list, and calculate the difference between each item without having to worry about
 * finding which adapters are within 3 of the previous one etc.
 */
$adapters = explode("\n", file_get_contents('input.txt'));

sort($adapters);

// Prefill with 2 numbers. The first adapter should have a difference against 0, the outlet.
// The device will always have a difference of 3 against the highest rated adapter. (all set out
// in the challenge spec)
$differences = [reset($adapters), 3];

for($i = 1; $i < count($adapters); $i++) {
    $differences[] = $adapters[$i] - $adapters[$i-1];
}

$uniqueDiffs = array_count_values($differences);

echo "Answer: " . ($uniqueDiffs[1] * $uniqueDiffs[3]) . "\n";