<?php
/**
 * https://adventofcode.com/2020/day/6
 *
 * "The form asks a series of 26 yes-or-no questions marked a through z.
 * All you need to do is identify the questions for which anyone in your
 * group answers "yes". Each group's answers are separated by a blank
 * line, and within each group, each person's answers are on a single line.
 * Duplicate answers to the same question don't count extra; each question
 * counts at most once.
 *
 * For each group, count the number of questions to which anyone answered "yes".
 *
 * What is the sum of those counts?"
 */

$groups = explode("\n\n", file_get_contents("input.txt"));

$count = 0;

foreach ($groups as $group) {
    $answers = [];

    $people = explode("\n", $group);

    foreach ($people as $person) {
        $answers = array_merge($answers, str_split($person));
    }

    $count += count(array_unique($answers));
}

echo "Answer: " . $count . "\n";