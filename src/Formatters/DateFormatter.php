<?php

namespace App\Formatters;

use DateTime;
use DateTimeZone;
use Exception;

/**
 * Undocumented class
 */
class DateFormatter implements IFieldFormatter
{
    protected $params = [
        'pattern' => '',
        'locale' => '',
        'timezone' => '',
    ];

    public function __construct()
    {
        $this->params['locale'] = locale_get_default();
        $this->params['timezone'] = date_default_timezone_get();
    }

    public function format($value, array $params)
    {
        $params = $this->getParams($params);

        try {
            $dateValue = new \DateTime($value, new DateTimeZone($params['timezone']));

            $fmt = new \IntlDateFormatter(
                $params['locale'],
                \IntlDateFormatter::FULL,
                \IntlDateFormatter::FULL,
                $params['timezone'],
                \IntlDateFormatter::GREGORIAN,
                $params['pattern']
            );
            
            return $fmt->format($dateValue);
        } catch (Exception $e) {
            
        }

        return "";
    }

    public function getParams(array $params): array
    {
        return array_merge($this->params, $params);
    }
}
