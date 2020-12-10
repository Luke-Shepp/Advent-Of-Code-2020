<?php
/**
 * https://adventofcode.com/2020/day/7
 *
 * "How many individual bags are required inside your single shiny gold bag?"
 */

include('inc.php');

$rules = parseRules();

// Example:
// shiny gold bags contain 2 dark red bags.
// dark red bags contain 2 dark orange bags.
// dark orange bags contain no other bags.
// ---
//      SG
//     /   \
//   DR     DR     = 2
//  /  \    /  \   +
// DO  DO  DO  DO  = 2 * 2
//                 ----
//                 = 6

function countInnerBags($startBag, $rules) {
    $total = 0;

    // Bag doesn't contain any others.
    if (! isset($rules[$startBag])) {
        return 0;
    }

    foreach ($rules[$startBag] as $innerBag => $count) {
        // How many of the current bag, plus how many bags inside the inner bags of this bag
        $total += $count + ($count * countInnerBags($innerBag, $rules));
    }

    return $total;
}

echo "Answer: " . countInnerBags('shiny gold', $rules) . "\n";