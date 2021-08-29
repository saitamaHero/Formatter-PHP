<?php

namespace App\Formatters;

/**
 * Undocumented class
 */
class TextFormatter extends BaseFieldFormatter
{
    protected $params = [
        'transform' => '',
        'truncate' => 0,
    ];

    protected $regexTransformationsSplitter = '/\,/';

    protected function transform($value)
    {
        $textTransformations = preg_split($this->regexTransformationsSplitter, $this->getParam('transform'));

        foreach ($textTransformations as $transform) {

            switch ($transform) {
                case 'lower':
                    $value = mb_strtolower($value);
                    break;

                case 'upper':
                    $value = mb_strtoupper($value);
                    break;

                case 'reverse':
                    $value = strrev($value);
                    break;
            }
        }

        if ($this->getParam('truncate') > 0) {
            $value = mb_substr($value, 0, $this->getParam('truncate'));
        }

        return $value;
    }
}
