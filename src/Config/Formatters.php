<?php


$formats = [
    'date' => App\Formatters\DateFormatter::class,
    'number' => App\Formatters\NumberFormatter::class,
    'percent' => App\Formatters\PercentFormatter::class,
    'text' => App\Formatters\TextFormatter::class,
];

return $formats;
