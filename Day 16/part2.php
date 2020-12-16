<?php
/**
 * https://adventofcode.com/2020/day/16
 *
 * "Now that you've identified which tickets contain invalid values, discard
 * those tickets entirely. Use the remaining valid tickets to determine which
 * field is which. Using the valid ranges for each field, determine what order
 * the fields appear on the tickets. The order is consistent between all
 * tickets: if seat is the third field, it is the third field on every ticket,
 * including your ticket.
 *
 * Once you work out which field is which, look for the six fields on your
 * ticket that start with the word departure. What do you get if you multiply
 * those six values together?"
 */

$input = explode("\n\n", file_get_contents('input.txt'));

// Parse rules
$rules = [];
$validNumbers = [];
foreach (explode("\n", $input[0]) as $rule) {
    $matches = [];

    preg_match('/^([a-z ]+)\: ([0-9]+)\-([0-9]+) or ([0-9]+)\-([0-9]+)$/', $rule, $matches);

    $range1 = range($matches[2], $matches[3]);
    $range2 = range($matches[4], $matches[5]);

    $rules[$matches[1]] = array_merge($range1, $range2);

    $validNumbers = array_merge($validNumbers, $range1, $range2);
}

// Parse nearby tickets
$nearby = explode("\n", $input[2]);
array_shift($nearby); // removes the "nearby tickets:" heading
foreach ($nearby as &$ticket) {
    $ticket = explode(',', $ticket);
}
unset($ticket);

// Extract only valid tickets
$validTickets = [];
foreach ($nearby as $i => $ticket) {
    if (empty(array_diff($ticket, $validNumbers))) {
        $validTickets[] = $ticket;
    }
}

// Parse my ticket
$myTicket = explode(',', explode("\n", $input[1])[1]);

$map = [];
$uncheckedColumns = range(0, count($rules) - 1);

// Not pretty. Loop each column, check each available rule against the column.
// if there's one rule that matches, awesome, we'll use that. Else, continue trying
// all other columns. When we get to the end of available columns to check, start again
// and attempt to narrow down on the columns that had multiple rules matching.
// ---
// This took way too long to figure out, and there 100% has to be a better way - one
// to come back to.

while (count($uncheckedColumns)) {
    foreach ($uncheckedColumns as $i) {
        $colRules = [];
        foreach ($rules as $name => $rule) {
            foreach ($validTickets as $ticket) {
                if (! in_array($ticket[$i], $rule)) {
                    continue 2;
                }
            }
            $colRules[] = $name;
        }

        if (count($colRules) > 1) {
            continue;
        }

        $map[$i] = $colRules[0];

        // Don't check this column or rule again
        unset($uncheckedColumns[$i]);
        unset($rules[$colRules[0]]);
    }
}

// Multiply all values in my ticket where the field starts with "departure"
$departureDigits = [];
foreach ($map as $index => $rule) {
    if (substr($rule, 0, 9) == "departure") {
        $departureDigits[] = $myTicket[$index];
    }
}

echo "Answer: " . array_product($departureDigits) . "\n";