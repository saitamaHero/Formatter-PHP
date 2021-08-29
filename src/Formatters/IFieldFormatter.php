<?php

namespace App\Formatters;

interface IFieldFormatter
{
    public function format($value, array $params);

    public function getParam(string $key);
}
