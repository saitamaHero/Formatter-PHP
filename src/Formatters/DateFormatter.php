<?php

namespace App\Formatters;

use DateTime;
use DateTimeZone;
use Exception;

/**
 * Undocumented class
 */
class DateFormatter extends BaseFieldFormatter
{
    protected $params = [
        'pattern' => '',
        'locale' => '',
        'timezone' => '',
    ];

    public function __construct()
    {
        //using server defaults for the locale and timezone
        $this->params['locale'] = locale_get_default();
        $this->params['timezone'] = date_default_timezone_get();
    }

    protected function transform($value)
    {
        try {
            $dateValue = new \DateTime($value, new DateTimeZone($this->getParam('timezone')));

            $fmt = new \IntlDateFormatter(
                $this->getParam('locale'),
                \IntlDateFormatter::FULL,
                \IntlDateFormatter::FULL,
                $this->getParam('timezone'),
                \IntlDateFormatter::GREGORIAN,
                $this->getParam('pattern')
            );

            return $fmt->format($dateValue);
        } catch (Exception $e) {
        }

        return null;
    }
}
