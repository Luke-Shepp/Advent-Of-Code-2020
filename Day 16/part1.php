<?php
/**
 * https://adventofcode.com/2020/day/16
 *
 * "The train ticket you were given is in a language you don't understand. You
 * should probably figure out what it says before you get to the train station after
 * the next flight.
 * Unfortunately, you can't actually read the words on the ticket. You can, however,
 * read the numbers, and so you figure out the fields these tickets must have and
 * the valid ranges for values in those fields.
 * You collect the rules for ticket fields, the numbers on your ticket, and the numbers
 * on other nearby tickets for the same train service
 *
 * Consider the validity of the nearby tickets you scanned. What is your ticket
 * scanning error rate?"
 */

$input = explode("\n\n", file_get_contents('input.txt'));

$rules = explode("\n", $input[0]);

$validNumbers = [];

foreach ($rules as $rule) {
    $matches = [];

    preg_match('/^([a-z ]+)\: ([0-9]+)\-([0-9]+) or ([0-9]+)\-([0-9]+)$/', $rule, $matches);

    $validNumbers = array_merge(
        $validNumbers,
        range($matches[2], $matches[3]),
        range($matches[4], $matches[5])
    );
}

$nearby = explode("\n", $input[2]);
array_shift($nearby); // removes the "nearby tickets:" heading

$errorRate = 0;

foreach ($nearby as $ticket) {
    $numbers = explode(',', $ticket);

    $errorRate += array_sum(array_diff($numbers, $validNumbers));
}

echo "Answer: " . $errorRate . "\n";