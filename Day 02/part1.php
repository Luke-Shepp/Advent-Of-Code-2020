<?php
/*
 * https://adventofcode.com/2020/day/2
 *
 * "Each line gives the password policy and then the password. The password
 * policy indicates the lowest and highest number of times a given letter
 * must appear for the password to be valid. For example, 1-3 a means that
 * the password must contain a at least 1 time and at most 3 times.
 *
 * How many passwords are valid according to their policies?"
 */

$entries = explode("\n", file_get_contents('input.txt'));

$validCount = 0;

foreach ($entries as $entry) {
    $policy = [];
    preg_match('/([0-9]+)\-([0-9]+)\s([a-z])\:\s(.*)/', $entry, $policy);

    [$x, $min, $max, $char, $password] = $policy;

    $diff = strlen($password) - strlen(str_replace($char, '', $password));

    if ($diff <= $max && $diff >= $min) {
        $validCount++;
    }
}

echo "Answer: " . $validCount . "\n";
