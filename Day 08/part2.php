<?php
/**
 * https://adventofcode.com/2020/day/8
 *
 * "Somewhere in the program, either a jmp is supposed to be a nop, or a
 * nop is supposed to be a jmp. (No acc instructions were harmed in the
 * corruption of this boot code.)
 *
 * Fix the program so that it terminates normally by changing exactly one
 * jmp (to nop) or nop (to jmp). What is the value of the accumulator after
 * the program terminates?"
 */

$instructions = explode("\n", file_get_contents('input.txt'));

function runInstructions(array $instructions): ?int
{
    $pntr    = 0;
    $acc     = 0;
    $history = [];

    while (! in_array($pntr, $history)) {
        $history[] = $pntr;

        // Reached the end of the instruction set - the program hasn't looped (this is good)!
        if (! isset($instructions[$pntr])) {
            return $acc;
        }

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

    return null;
}

for ($i = 0; $i < count($instructions); $i++) {
    $substitute = [
        'jmp' => 'nop',
        'nop' => 'jmp',
    ];

    [$op, $arg] = explode(' ', $instructions[$i]);

    if ($op == 'acc') continue;

    // Modify the instruction according to substitutions list
    $modifiedSet = $instructions;
    $modifiedSet[$i] = $substitute[$op] . ' ' . $arg;

    // Run the program with modified instruction set and check for a non-null output,
    // signifying the program has ran it's course and not infinite-looped.
    $output = runInstructions($modifiedSet);

    if (! is_null($output)) {
        echo "Answer: " . $output . "\n";
        break;
    }
}
