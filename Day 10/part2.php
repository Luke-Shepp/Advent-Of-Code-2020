<?php
/**
 * https://adventofcode.com/2020/day/10
 *
 * "To completely determine whether you have enough adapters, you'll need to figure out
 * how many different ways they can be arranged. You glance back down at your bag and
 * try to remember why you brought so many adapters; there must be more than a
 * trillion valid ways to arrange them!
 *
 * What is the total number of distinct ways you can arrange the adapters to connect
 * the charging outlet to your device?"
 */

$adapters = explode("\n", file_get_contents('input.txt'));

$adapters[] = 0;
sort($adapters);

// There's always 1 way to get to the first adapter, from the outlet.
$permutations = [1];

// Calculate how many paths there are, by how many choices we have if there are
// multiple numbers within 3 of a previous number.
// i.e. an input of 1,4,5,6 would allow you to reach 6 by going from either 5 or 4,
// and you could only reach 4 by going from 1.
for($i = 0; $i < count($adapters); $i++) {
    for ($j = 0; $j < $i; $j ++) {
        if ($adapters[$i] - $adapters[$j] <= 3) {
            $permutations[$i] = ($permutations[$i] ?? 0) + ($permutations[$j] ?? 0);
        }
    }
}

echo "Answer: " . end($permutations) . "\n";
