<?php
/**
 * https://adventofcode.com/2020/day/12
 *
 * "Unfortunately, the ship's navigation computer seems to be malfunctioning;
 * rather than giving a route directly to safety, it produced extremely circuitous
 * instructions.
 * The navigation instructions (your puzzle input) consists of a sequence of
 * single-character actions paired with integer input values.
 * The ship starts by facing east. Only the L and R actions change the direction the
 * ship is facing. (That is, if the ship is facing east and the next instruction is
 * N10, the ship would move north 10 units, but would still move east if the
 * following action were F.)
 *
 * Figure out where the navigation instructions lead. What is the Manhattan
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

$rotations = [NORTH, EAST, SOUTH, WEST];
$heading   = EAST;
$position  = [0, 0]; // +e/-w  , +n/-s

foreach ($instructions as $instruction) {
    $action = $instruction[0];
    $value  = substr($instruction, 1);

    switch($action) {
        case FORWARD:
            $position[0] += $modifiers[$heading][0] * $value;
            $position[1] += $modifiers[$heading][1] * $value;
            break;

        case NORTH:
        case SOUTH:
        case EAST:
        case WEST:
            $position[0] += $modifiers[$action][0] * $value;
            $position[1] += $modifiers[$action][1] * $value;
            break;

        case LEFT:
        case RIGHT:
            $toRotate = $value / 90;
            if ($action == LEFT) {
                $toRotate *= -1;
            }
            $newPos = array_search($heading, $rotations,true) + $toRotate;
            if ($newPos < 0) {
                $newPos += 4;
            }
            if ($newPos >= 4) {
                $newPos %= 4;
            }
            $heading = $rotations[$newPos];
            break;

    }
}

echo "Answer: " . array_sum(array_map('abs', $position)) . "\n";