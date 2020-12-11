<?php
/**
 * https://adventofcode.com/2020/day/11
 *
 * "You make a quick map of the seat layout. The seat layout fits neatly on a grid.
 * Each position is either floor (.), an empty seat (L), or an occupied seat (#).
 * People are entirely predictable and always follow a simple set of rules. All
 * decisions are based on the number of occupied seats adjacent to a given seat
 * (one of the eight positions immediately up, down, left, right, or diagonal from the seat).
 *
 * The following rules are applied to every seat simultaneously:
 * - If a seat is empty (L) and there are no occupied seats adjacent to it, the seat becomes occupied.
 * - If a seat is occupied (#) and four or more seats adjacent to it are also occupied, the seat becomes empty.
 * - Otherwise, the seat's state does not change.
 * - Floor (.) never changes; seats don't move, and nobody sits on the floor.
 *
 * Part 1:
 * Simulate your seating area by applying the seating rules repeatedly until no seats change
 * state. How many seats end up occupied?
 *
 * Part 2:
 * People don't just care about adjacent seats - they care about the first seat they
 * can see in each of those eight directions! Also, people seem to be more tolerant than you
 * expected: it now takes five or more visible occupied seats for an occupied seat to become empty
 *
 * Given the new visibility method and the rule change for occupied seats becoming empty, once
 * equilibrium is reached, how many seats end up occupied?
 */

const FLOOR      = '.';
const OCCUPIED   = '#';
const UNOCCUPIED = 'L';

/**
 * Count how many adjacent seats are occupied.
 *
 * If moreTolerant is true, then check the first seat in each direction, instead of
 * the less tolerant version of just checking the 8 seats in the immediate vicinity.
 *
 * @param array $seats
 * @param int $x
 * @param int $y
 * @param bool $moreTolerant
 * @return int
 */
function adjacentOccupiedCount(array $seats, int $x, int $y, bool $moreTolerant): int
{
    $directions = [[-1, -1], [-1, 1], [1, -1], [1, 1], [0, -1], [0, 1], [1, 0], [-1, 0]];

    $count = 0;

    foreach ($directions as $direction) {
        // Modifier allows checking further afield by multiplying the direction values
        $modifier = 1;

        while (true) {
            $seat = $seats[$y + ($direction[0] * $modifier)][$x + ($direction[1] * $modifier)] ?? '';

            if ($seat != FLOOR) {
                if ($seat == OCCUPIED) {
                    $count++;
                }
                break;
            }

            // More tolerant people will be interested in the state of the first seat they see in
            // each direction. Less tolerant people care about only the immediate vicinity.
            // Therefore, for less tolerant people we can exit the loop here without checking
            // further afield.
            if (! $moreTolerant) {
                break;
            }

            $modifier++;
        }
    }

    return $count;
}

/**
 * Count the total number of occupied seats
 *
 * @param array $seats
 * @return int
 */
function countOccupiedSeats(array $seats): int
{
    $count = 0;

    foreach ($seats as $row) {
        foreach ($row as $seat) {
            if ($seat == OCCUPIED) {
                $count++;
            }
        }
    }

    return $count;
}

/**
 * Runs the program/simulation.
 *
 * @param $seats
 * @param bool $moreTolerant
 * @return int Number of occupied seats when occupancy has reached equilibrium
 */
function run($seats, bool $moreTolerant = false): int
{
    $changed = true;

    while ($changed) {
        $changed = false;
        $newState = $seats;

        for ($y = 0; $y < count($seats); $y++) {
            for ($x = 0; $x < count($seats[$y]); $x++) {
                $adjacentOccupied = adjacentOccupiedCount($seats, $x, $y, $moreTolerant);

                if ($seats[$y][$x] == UNOCCUPIED && $adjacentOccupied == 0) {
                    $newState[$y][$x] = OCCUPIED;
                    $changed = true;
                } elseif ($seats[$y][$x] == OCCUPIED && $adjacentOccupied >= ($moreTolerant ? 5 : 4)) {
                    $newState[$y][$x] = UNOCCUPIED;
                    $changed = true;
                }
            }
        }

        $seats = $newState;
    }

    return countOccupiedSeats($seats);
}

$input = file_get_contents('input.txt');
$seats = array_map('str_split', explode("\n", $input));

echo "Answer Part 1: " . run($seats, false) . "\n";
echo "Answer Part 2: " . run($seats, true) . "\n";