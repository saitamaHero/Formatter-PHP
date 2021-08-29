<?php

namespace App\Formatters;

/**
 * Undocumented class
 */
class PercentFormatter implements IFieldFormatter
{
    protected $params = [
        'base' => 100,
        'decimals' => 0
    ];

    public function format($value, array $params)
    {
        $params = $this->getParams($params);

        if (!is_numeric($value)) {
            return NULL;
        }

        if ($params['base'] > 0) {
            $value = $value * $params['base'];
        }
        

        return sprintf("%s%%", number_format($value, $params['decimals']));
    }

    public function getParams(array $params): array
    {
        return array_merge($this->params, $params);
    }
}
