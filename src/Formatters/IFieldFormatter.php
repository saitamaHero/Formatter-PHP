<?php

namespace App\Formatters;

interface IFieldFormatter
{
    public function format($value, array $params);

    public function getParams(array $params) : array;
}
