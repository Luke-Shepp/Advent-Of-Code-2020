<?php
/**
 * https://adventofcode.com/2020/day/8
 *
 * "The boot code is represented as a text file with one instruction per line
 * of text. Each instruction consists of an operation (acc, jmp, or nop) and
 * an argument (a signed number like +4 or -20).
 *
 * This is an infinite loop: with this sequence of jumps, the program will run forever.
 * The moment the program tries to run any instruction a second time, you know it
 * will never terminate.
 *
 * Run your copy of the boot code. Immediately before any instruction is executed a
 * second time, what value is in the accumulator?"
 */

$instructions = explode("\n", file_get_contents('input.txt'));

$acc     = 0;
$history = [];
$pntr    = 0;

while (! in_array($pntr, $history)) {
    $history[] = $pntr;

    [$op, $arg] = explode(' ', $instructions[$pntr]);

    if ($op == 'acc') {
        $acc += (int) $arg;
    }

    if ($op == 'jmp') {
        $pntr += (int) $arg;
        continue;
    }

    $pntr++;
}

echo "Answer: $acc\n";