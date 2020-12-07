<?php

/**
 * Parse input file into rules array.
 *
 * Shared between both parts.
 *
 * @return array
 */
function parseRules()
{
    $lines = explode("\n", file_get_contents('input.txt'));

    $rules = [];

    // Parse the input into a formatted array
    foreach ($lines as $line) {
        $split = preg_split('/ bags?,?\s?(?:contain )?/', $line);

        for($i = 1; $i < count($split); $i++) {
            if ($split[$i] === '.') continue;
            if ($split[$i] === 'no other') continue;

            $bag = explode(' ', $split[$i], 2);
            $rules[$split[0]][$bag[1]] = $bag[0];
        }
    }

    return $rules;

}