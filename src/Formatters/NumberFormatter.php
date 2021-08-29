<?php

namespace App\Formatters;

/**
 * Undocumented class
 */
class NumberFormatter implements IFieldFormatter
{
    protected $params = [
        'decimals' => 0,
        'decimal_sep' => null,
        'thousands_sep' => null
    ];

    public function format($value, array $params)
    {
        $params = $this->getParams($params);

        if (!is_numeric($value)) {
            return NULL;
        }

        return number_format($value, $params['decimals'], $params['decimal_sep'], $params['thousands_sep']);
    }

    public function getParams(array $params): array
    {
        return array_merge($this->params, $params);
    }
}
