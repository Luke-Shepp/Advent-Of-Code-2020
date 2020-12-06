<?php
/**
 * https://adventofcode.com/2020/day/6
 *
 * "As you finish the last group's customs declaration, you notice that you
 * misread one word in the instructions: You don't need to identify the questions
 * to which *anyone* answered "yes"; you need to identify the questions to which
 * *everyone* answered "yes"!
 *
 * For each group, count the number of questions to which everyone answered "yes".
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

    // The first array_count_values will group and count the characters, the second
    // array_count_values will count how many of those counts are equal to the number
    // of people in this group.
    $count += array_count_values(array_count_values($answers))[count($people)] ?? 0;
}

echo "Answer: " . $count . "\n";