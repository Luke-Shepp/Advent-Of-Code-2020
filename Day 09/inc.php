<?php

/**
 * Fetches the input file split at newlines
 *
 * @return array
 */
function getInput(): array
{
    return explode("\n", file_get_contents('input.txt'));
}

/**
 * Returns the first invalid number in the input
 *
 * @return int
 */
function getInvalidNumber(): int
{
    $numbers = getInput();

    for ($i = 25; $i < count($numbers); $i++) {
        if (! isValid($i, $numbers[$i], $numbers)) {
            return $numbers[$i];
        }
    }

    return 0;
}

/**
 * Checks if the target is the sum of any numbers in the last 25 numbers.
 *
 * @param int $loopPtr
 * @param int $target
 * @param array $numbers
 * @return bool
 */
function isValid(int $loopPtr, int $target, array $numbers): bool
{
    $subset = array_slice($numbers, $loopPtr - 25, 25);

    foreach ($subset as $one) {
        foreach ($subset as $two) {
            if ($one + $two == $target && $one !== $two) {
                return true;
            }
        }
    }

    return false;
}
