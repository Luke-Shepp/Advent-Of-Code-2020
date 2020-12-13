<?php
/**
 * https://adventofcode.com/2020/day/13
 *
 * "Each bus has an ID number that also indicates how often the bus leaves
 * for the airport. Bus schedules are defined based on a timestamp that measures
 * the number of minutes since some fixed reference point in the past. At timestamp
 * 0, every bus simultaneously departed from the sea port. After that, each bus
 * travels to the airport, then various other locations, and finally returns to
 * the sea port to repeat its journey forever.
 *
 * The time this loop takes a particular bus is also its ID number: the bus with
 * ID 5 departs from the sea port at timestamps 0, 5, 10, 15, and so on.
 *
 * The first line is your estimate of the earliest timestamp you could depart
 * on a bus. The second line lists the bus IDs that are in service according
 * to the shuttle company; entries that show x must be out of service, so you
 * decide to ignore them.
 *
 * What is the ID of the earliest bus you can take to the airport multiplied by the
 * number of minutes you'll need to wait for that bus?"
 */

$input = explode("\n", file_get_contents('input.txt'));

$earliest = $input[0];
$busses   = explode(',', $input[1]);
$busses   = array_filter($busses, fn($id) => $id != 'x');

$time = $earliest;

while (true) {
    foreach ($busses as $id) {
        if ($time % $id == 0) {
            echo "Answer: " . ($time - $earliest) * $id . "\n";
            break 2;
        }
    }
    $time++;
}