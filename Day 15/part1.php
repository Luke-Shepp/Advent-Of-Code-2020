<?php
/**
 * https://adventofcode.com/2020/day/15
 *
 * "While you wait for your flight, you decide to check in with the Elves
 * back at the North Pole. They're playing a memory game and are ever
 * so excited to explain the rules!
 *
 * In this game, the players take turns saying numbers. They begin by
 * taking turns reading from a list of starting numbers (your puzzle input).
 * Then, each turn consists of considering the most recently spoken number:
 * - If that was the first time the number has been spoken, the current player says 0.
 * - Otherwise, the number had been spoken before; the current player announces how many
 *   turns apart the number is from when it was previously spoken.
 *
 * Their question for you is: what will be the 2020th number spoken?"
 */

$numbers = explode(',', file_get_contents('input.txt'));

while (count($numbers) < 2020) {
    $occourances = array_reverse(array_keys($numbers, end($numbers)));

    $numbers[] = (count($occourances) > 1 ? $occourances[0] - $occourances[1] : 0);
}

echo "Answer: " . $numbers[2019] . "\n";