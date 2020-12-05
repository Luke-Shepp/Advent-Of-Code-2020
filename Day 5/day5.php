<?php
/**
 * https://adventofcode.com/2020/day/5
 *
 * "Instead of zones or groups, this airline uses binary space partitioning to seat people.
 *
 * The first 7 characters will either be F or B; these specify exactly one of the 128 rows
 * on the plane (numbered 0 through 127). Each letter tells you which half of a region the
 * given seat is in. Start with the whole list of rows; the first letter indicates whether
 * the seat is in the front (0 through 63) or the back (64 through 127). The next letter
 * indicates which half of that region the seat is in, and so on until you're left with
 * exactly one row.
 *
 * The last three characters will be either L or R; these specify exactly one of the 8
 * columns of seats on the plane (numbered 0 through 7). The same process as above proceeds
 * again, this time with only three steps. L means to keep the lower half, while R means
 * to keep the upper half.
 *
 * Every seat also has a unique seat ID: multiply the row by 8, then add the column.
 *
 * Part 1: As a sanity check, look through your list of boarding passes. What is the
 * highest seat ID on a boarding pass?
 *
 * Part 2: Your seat wasn't at the very front or back, though; the seats with IDs +1 and -1
 * from yours will be in your list. What is the ID of your seat?"
 */

$seats = explode("\n", file_get_contents('input.txt'));

// Find the mid point of the col/row array
function mid(array $x) {
    return array_sum($x) / 2;
}

$seatIds = [];

foreach ($seats as $seat) {
    $row = [0, 127];
    $column = [0, 7];

    for($i = 0; $i < strlen($seat); $i++) {
        switch($seat[$i]) {
            case 'B':
                $row[0] = ceil(mid($row));
                break;
            case 'F':
                $row[1] = floor(mid($row));
                break;
            case 'R':
                $column[0] = ceil(mid($column));
                break;
            case 'L':
                $column[1] = floor(mid($column));
                break;
        }
    }

    $seatIds[$seat] = ($row[0] * 8) + $column[0];
}

echo "Answer Part 1: " . max(array_values($seatIds)) . "\n";

for ($i = min($seatIds); $i <= max($seatIds); $i++) {
    if (! in_array($i, $seatIds)) {
        echo "Your seat ID (Part 2 Answer): " . $i . "\n";
        break;
    }
}