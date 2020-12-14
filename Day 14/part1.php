<?php
/**
 * https://adventofcode.com/2020/day/14
 *
 * "The computer system that runs this port isn't compatible with the docking
 * program on the ferry. After a brief inspection, you discover that the sea
 * port's computer system uses a strange bitmask system in its initialization program.
 *
 * The initialization program (your puzzle input) can either update the bitmask
 * or write a value to memory. Values and memory addresses are both 36-bit unsigned
 * integers. For example, ignoring bitmasks for a moment, a line like mem[8] = 11
 * would write the value 11 to memory address 8.
 *
 * The current bitmask is applied to values immediately before they are written to
 * memory: a 0 or 1 overwrites the corresponding bit in the value, while an X leaves
 * the bit in the value unchanged.
 *
 * What is the sum of all values left in memory after it completes?"
 */

$lines = explode("\n", file_get_contents('input.txt'));
$mask  = '';
$mem   = [];

foreach ($lines as $line) {
    if (substr($line, 0, 4) == 'mask') {
        $mask = explode(' = ', $line)[1];
        continue;
    }

    $matches = [];
    preg_match('/^mem\[([0-9]+)\]\ \=\ ([0-9]+)/', $line, $matches);
    [, $address, $value] = $matches;

    // Decimal to binary on the value, padded to 36 bits.
    $bin = str_pad(decbin($value), 36, 0, STR_PAD_LEFT);

    // Apply the mask
    for ($i = 0; $i < strlen($mask); $i++) {
        if ($mask[$i] == 'X') continue;
        $bin[$i] = $mask[$i];
    }

    $mem[$address] = bindec($bin);
}

echo "Answer: " . array_sum($mem) . "\n";