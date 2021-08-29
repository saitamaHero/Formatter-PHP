<?php

require 'vendor/autoload.php';





$fieldFormat = (object)[
    'value' => 320556000.36366552,
    'format' => 'number|decimals[3]'
];

echo sprintf(
    "<p style=\"font-size: 24px;\">El valor <strong style=\"color: red;\">'%s'</strong> ha sido formateado a <strong style=\"color: red;\">'%s'</strong></p>",
    $fieldFormat->value,
    format($fieldFormat->value, $fieldFormat->format)
);

$fieldFormat = (object)[
    'value' => "2020-03-18 22:00:00",
    'format' => 'date|pattern[eeee dd MMMM yyy hh:mm a]'
];

echo sprintf(
    "<p style=\"font-size: 24px;\">El valor <strong style=\"color: red;\">'%s'</strong> ha sido formateado a <strong style=\"color: red;\">'%s'</strong></p>",
    $fieldFormat->value,
    format($fieldFormat->value, $fieldFormat->format)
);

$fieldFormat = (object)[
    'value' => 58.69659,
    'format' => 'percent|decimals[2]|base[1]',
];

echo sprintf(
    "<p style=\"font-size: 24px;\">El valor <strong style=\"color: red;\">'%s'</strong> ha sido formateado a <strong style=\"color: red;\">'%s'</strong></p>",
    $fieldFormat->value,
    format($fieldFormat->value, $fieldFormat->format)
);


$fieldFormat = (object)[
    'value' => "Hola Mundo!",
    'format' => 'text|transform[reverse,upper]|truncate[5]',
];


echo sprintf(
    "<p style=\"font-size: 24px;\">El valor <strong style=\"color: red;\">'%s'</strong> ha sido formateado a <strong style=\"color: red;\">'%s'</strong></p>",
    $fieldFormat->value,
    format($fieldFormat->value, $fieldFormat->format)
);




function getParam($param)
{
    $regexExtractParam = "/^[a-zA-Z_]+/";
    $regexExtractParamValue = "/\[(.+)\]/";

    $matchesParamName = null;
    $matchesParamValues = null;

    preg_match($regexExtractParam, $param, $matchesParamName);
    preg_match($regexExtractParamValue, $param, $matchesParamValues);

    if (!empty($matchesParamName)) {
        $name = $matchesParamName[0];

        $value = trim(empty($matchesParamValues) ? null : $matchesParamValues[1]);

        return [
            $name => $value
        ];
    }

    return null;
}


function format($value, $format)
{
    $formatters = require('src/Config/Formatters.php');

    $formatParams = preg_split("/\|/", $format);
    $formatter = $formatParams[0];

    if (key_exists($formatter, $formatters)) {
        $formatterClass = $formatters[$formatter];
        $currentFormatter = new $formatterClass;

        $params = [];

        foreach (array_slice($formatParams, 1) as $param) {
            $params = array_merge($params, getParam($param));
        }

        return $currentFormatter->format($value, $params);
    }

    return null;
}
