<?php
/**
 * https://adventofcode.com/2020/day/13
 *
 * "What is the earliest timestamp such that all of the listed
 * bus IDs depart at offsets matching their positions in the list?
 * An x in the schedule means there are no constraints on what bus
 * IDs must depart at that time."
 */

$input  = explode("\n", file_get_contents('input.txt'));
$busses = explode(',', $input[1]);

$time = 0;

for ($i = 1; $i < count($busses); $i++) {
    if ($busses[$i] == 'x') {
        continue;
    }

    $newTime = $busses[$i];
    while (true) {
        $time += $busses[0];
        if (($time + $i) % $newTime == 0) {
            $busses[0] *= $newTime;
            break;
        }
    }
}

echo "Answer: " . $time;