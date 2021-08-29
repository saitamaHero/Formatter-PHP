<?php

namespace App\Formatters;

/**
 * Undocumented class
 */
class NumberFormatter extends BaseFieldFormatter
{
    protected $params = [
        'decimals' => 0,
        'decimal_sep' => null,
        'thousands_sep' => null
    ];

    protected function transform($value)
    {
        if (!is_numeric($value)) {
            return NULL;
        }

        return number_format(
            $value,
            $this->getParam('decimals'),
            $this->getParam('decimal_sep'),
            $this->getParam('thousands_sep'),
        );
    }
}
