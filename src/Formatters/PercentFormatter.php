<?php

namespace App\Formatters;

/**
 * Undocumented class
 */
class PercentFormatter extends BaseFieldFormatter
{
    protected $params = [
        'base' => 100,
        'decimals' => 0,
        'not_round' => false
    ];

    protected function transform($value)
    {
        if (!is_numeric($value)) {
            return NULL;
        }

        if ($this->getParam('not_round')) {
            $value = floor($value * pow(10, $this->getParam('decimals'))) / pow(10, $this->getParam('decimals'));
        }

        if ($this->getParam('base') > 0) {
            $value = $value * $this->getParam('base');
        }

        return sprintf(
            "%s%%",
            number_format($value, $this->getParam('decimals'))
        );
    }
}
