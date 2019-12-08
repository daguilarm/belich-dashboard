<?php

if (!function_exists('randNumber')) {
    function randNumber(int $min, int $max, int $decimals = 0)
    {
        $float = mt_rand($min * 10, $max * 10) / 10;

        return $decimals > 0
            ? rand($min, $max)
            : number_format($float, $decimals);
    }
}
