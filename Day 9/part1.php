<?php
/**
 * https://adventofcode.com/2020/day/9
 *
 * "The data appears to be encrypted with the eXchange-Masking Addition System (XMAS)
 * which, conveniently for you, is an old cypher with an important weakness.
 * XMAS starts by transmitting a preamble of 25 numbers. After that, each number you
 * receive should be the sum of any two of the 25 immediately previous numbers. The
 * two numbers will have different values, and there might be more than one such pair.
 *
 * The first step of attacking the weakness in the XMAS data is to find the first number
 * in the list (after the preamble) which is not the sum of two of the 25 numbers before it.
 *
 * What is the first number that does not have this property?"
 */

// Functions are required in both parts today, so are split into a shared include.
include('inc.php');

echo "Answer: " . getInvalidNumber() . "\n";