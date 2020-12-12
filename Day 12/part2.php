<?php
/**
 * https://adventofcode.com/2020/day/12
 *
 * "Before you can give the destination to the captain, you realize that the actual
 * action meanings were printed on the back of the instructions the whole time.
 * Almost all of the actions indicate how to move a waypoint which is relative
 * to the ship's position.
 * The waypoint starts 10 units east and 1 unit north relative to the ship. The waypoint
 * is relative to the ship; that is, if the ship moves, the waypoint moves with it.
 *
 * Figure out where the navigation instructions actually lead. What is the Manhattan
 * distance between that location and the ship's starting position?"
 */

$instructions = explode("\n", file_get_contents('input.txt'));

const NORTH   = 'N';
const SOUTH   = 'S';
const WEST    = 'W';
const EAST    = 'E';
const FORWARD = 'F';
const LEFT    = 'L';
const RIGHT   = 'R';

$modifiers = [
    EAST  => [1, 0],
    WEST  => [-1, 0],
    SOUTH => [0, -1],
    NORTH => [0, 1],
];

$rotations    = [NORTH, EAST, SOUTH, WEST];
$shipHeading  = EAST;
$shipPosition = [0, 0]; // +e/-w  , +n/-s

$waypointPosition = [10, 1]; // +e/-w  , +n/-s

foreach ($instructions as $instruction) {
    $action = $instruction[0];
    $value  = substr($instruction, 1);

    switch($action) {
        case FORWARD:
            // Move ship towards waypoint $value times
            $shipPosition[0] += $waypointPosition[0] * $value;
            $shipPosition[1] += $waypointPosition[1] * $value;
            break;

        case NORTH:
        case SOUTH:
        case EAST:
        case WEST:
            // Move the waypoint the given direction $value times
            $waypointPosition[0] += $modifiers[$action][0] * $value;
            $waypointPosition[1] += $modifiers[$action][1] * $value;
            break;

        case LEFT:
        case RIGHT:
            // Rotate waypoint around 0,0
            if ($action == RIGHT) {
                $value = 360 - $value;
            }

            $sin = sin(deg2rad($value));
            $cos = cos(deg2rad($value));

            $xnew = $waypointPosition[0] * $cos - $waypointPosition[1] * $sin;
            $ynew = $waypointPosition[0] * $sin + $waypointPosition[1] * $cos;

            $waypointPosition[0] = $xnew;
            $waypointPosition[1] = $ynew;

            break;

    }
}

echo "Answer: " . array_sum(array_map('abs', $shipPosition)) . "\n";