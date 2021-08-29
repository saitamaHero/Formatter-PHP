<?php

namespace App\Formatters;

/**
 * Undocumented class
 */
class TextFormatter implements IFieldFormatter
{
    protected $params = [
        'transform' => '',
        'truncate' => 0,
    ];

    public function format($value, array $params)
    {
        $params = $this->getParams($params);

        if (empty($value)) {
            return "";
        }

        $value = $this->transform($value, $params['transform']);

        if ($params['truncate'] > 0) {
            $value = mb_substr($value, 0, $params['truncate']);
        }

        return $value;
    }

    protected function transform($value, $transform): string
    {
        $transforms = preg_split("/\,/", $transform);

        foreach ($transforms as $transform) {
        
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

        return $value;
    }

    public function getParams(array $params): array
    {
        return array_merge($this->params, $params);
    }
}
