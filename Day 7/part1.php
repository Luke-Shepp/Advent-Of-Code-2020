<?php
/**
 * https://adventofcode.com/2020/day/7
 *
 * "Due to recent aviation regulations, many rules (your puzzle input) are being
 * enforced about bags and their contents; bags must be color-coded and must
 * contain specific quantities of other color-coded bags.
 *
 * How many bag colors can eventually contain at least one shiny gold bag?"
 */

include('inc.php');

$rules = parseRules();

// Find the parent bag for the given bag. Calls itself to find the potential parent bags of any of these
function findParentBags($target, $rules) {
    $sourceBags = [];

    foreach ($rules as $bag => $innerBags) {
        if ($bag == $target) continue;

        if (isset($innerBags[$target])) {
            $sourceBags[] = $bag;
            $sourceBags = array_merge($sourceBags, findParentBags($bag, $rules));
        }
    }

    return $sourceBags;
}

echo "Answer: " . count(array_unique(findParentBags('shiny gold', $rules))) . "\n";