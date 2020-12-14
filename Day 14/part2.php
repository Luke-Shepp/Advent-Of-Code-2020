<?php
/**
 * https://adventofcode.com/2020/day/14
 *
 * "For some reason, the sea port's computer system still can't communicate
 * with your ferry's docking program. It must be using version 2 of the decoder chip!
 * A version 2 decoder chip doesn't modify the values being written at all. Instead,
 * it acts as a memory address decoder.
 *
 * Immediately before a value is written to memory, each bit in the bitmask modifies
 * the corresponding bit of the destination memory address in the following way:
 * - If the bitmask bit is 0, the corresponding memory address bit is unchanged.
 * - If the bitmask bit is 1, the corresponding memory address bit is overwritten with 1.
 * - If the bitmask bit is X, the corresponding memory address bit is floating.
 *
 * A floating bit is not connected to anything and instead fluctuates unpredictably. In
 * practice, this means the floating bits will take on all possible values, potentially
 * causing many memory addresses to be written all at once!
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

    // Decimal to binary on the address, padded to 36 bits.
    $bin = str_pad(decbin($address), 36, 0, STR_PAD_LEFT);

    // Apply the mask
    $addresses = [''];
    for ($i = 0; $i < strlen($mask); $i++) {
        if ($mask[$i] == '0') {
            $addresses = array_map(fn ($addr) => $addr .= $bin[$i], $addresses);
        } elseif ($mask[$i] == '1') {
            $addresses = array_map(fn ($addr) => $addr .= 1, $addresses);
        } elseif ($mask[$i] == 'X') {
            // Duplicate each target address, with both 0 and 1 appended.
            $forked = [];
            foreach ($addresses as $addr) {
                $forked[] = $addr . '0';
                $forked[] = $addr . '1';
            }
            $addresses = $forked;
        }
    }

    foreach ($addresses as $addr) {
        $mem[bindec($addr)] = $value;
    }
}

echo "Answer: " . array_sum($mem) . "\n";