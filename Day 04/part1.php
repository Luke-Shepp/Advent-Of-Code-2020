<?php
/**
 * https://adventofcode.com/2020/day/4
 *
 * "Passport data is validated in batch files (your puzzle input). Each passport
 * is represented as a sequence of key:value pairs separated by spaces or newlines.
 * Passports are separated by blank lines.
 *
 * Count the number of valid passports - those that have all required fields.
 * Treat cid as optional."
 */

$file = file_get_contents('input.txt');

// Passports are separated by blank lines.
$passports = explode("\n\n", $file);

// Group fields for each passport and extract key:value fields
array_walk($passports, function (&$passport) {
    $fields = preg_split('/\s/', $passport);

    $passport = [];

    foreach ($fields as $field) {
        [$key, $value] = explode(':', $field);
        $passport[$key] = $value;
    }
});

$validCnt = 0;

$requiredFields = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid'];

foreach ($passports as $passport) {
    $diff = array_diff($requiredFields, array_keys($passport));

    if (empty($diff) || (count($diff) == 1 && reset($diff) == 'cid')) {
        $validCnt++;
    }
}

echo "Valid: " . $validCnt . "\n";