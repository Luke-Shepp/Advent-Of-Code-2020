<?php
/*
 * https://adventofcode.com/2020/day/2
 *
 * "Each policy actually describes two positions in the password, where 1
 * means the first character, 2 means the second character, and so on.
 * (Be careful; Toboggan Corporate Policies have no concept of "index zero"!)
 * Exactly one of these positions must contain the given letter. Other occurrences
 * of the letter are irrelevant for the purposes of policy enforcement.
 *
 * How many passwords are valid according to the new interpretation of the policies?"
 */

$entries = explode("\n", file_get_contents('input.txt'));

$validCount = 0;

foreach ($entries as $entry) {
    $policy = [];
    preg_match('/([0-9]+)\-([0-9]+)\s([a-z])\:\s(.*)/', $entry, $policy);

    [$x, $pos1, $pos2, $char, $password] = $policy;

    // Ensure only one of pos1 or pos2 is the given character, taking into
    // account it's base 1.
    if(substr_count($password[$pos1-1] . $password[$pos2-1], $char) === 1) {
        $validCount++;
    }
}

echo "Answer: " . $validCount . "\n";
