<?php
/**
 * https://adventofcode.com/2020/day/4
 *
 * "Your job is to count the passports where all required fields are both present
 * and valid according to the rules"
 */

$file = file_get_contents('input.txt');

// Passports are separated by blank lines
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

// Use basic arrow functions to return bools for if the provided
// data is valid is not.
$validators = [
    'byr' => fn($x) => $x >= 1920 && $x <= 2002,
    'iyr' => fn($x) => $x >= 2010 && $x <= 2020,
    'eyr' => fn($x) => $x >= 2020 && $x <= 2030,
    'hgt' => fn($x) => (
        $x >= 150 && $x <= 193 && substr($x, -2) == 'cm' ||
        $x >= 59 && $x <= 76 && substr($x, -2) == 'in'
    ),
    'hcl' => fn($x) => preg_match('/^\#[0-9a-f]{6}$/', $x),
    'ecl' => fn($x) => preg_match('/^(amb|blu|brn|gry|grn|hzl|oth)$/', $x),
    'pid' => fn($x) => preg_match('/^[0-9]{9}$/', $x),
    'cid' => null,
];

foreach ($passports as $passport) {
    $valid = true;

    foreach ($validators as $key => $validator) {
        // Optional field
        if (is_null($validator)) {
            continue;
        }

        // Required fields, check they're valid
        if (! isset($passport[$key]) || ! $validator($passport[$key])) {
            $valid = false;
        }
    }

    if ($valid) {
        $validCnt++;
    }
}

echo "Valid: " . $validCnt . "\n";