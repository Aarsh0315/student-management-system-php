<?php

class SettingsHelper
{
    private static $settings = null;


    /*
    |--------------------------------------------------------------------------
    | LOAD SETTINGS
    |--------------------------------------------------------------------------
    */

    private static function loadSettings()
    {
        if (self::$settings !== null) {
            return self::$settings;
        }

        try {

            $modelPath =
                dirname(__DIR__) .
                '/models/SettingsModel.php';

            if (!file_exists($modelPath)) {
                self::$settings = [];
                return self::$settings;
            }

            require_once $modelPath;

            $settingsModel =
                new SettingsModel();

            self::$settings =
                $settingsModel->getAllAsArray();

            return self::$settings;

        } catch (Throwable $e) {

            self::$settings = [];

            return self::$settings;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | GET SETTING
    |--------------------------------------------------------------------------
    */

    public static function get(
        $key,
        $default = null
    ) {
        $settings =
            self::loadSettings();

        return $settings[$key]
            ?? $default;
    }


    /*
    |--------------------------------------------------------------------------
    | GET TIMEZONE
    |--------------------------------------------------------------------------
    */

    public static function getTimezone()
    {
        $timezone =
            self::get(
                'timezone',
                'Asia/Kolkata'
            );

        try {

            new DateTimeZone($timezone);

            return $timezone;

        } catch (Throwable $e) {

            return 'Asia/Kolkata';
        }
    }


    /*
    |--------------------------------------------------------------------------
    | FORMAT DATE
    |--------------------------------------------------------------------------
    */

    public static function formatDate(
        $date,
        $default = null
    ) {
        if (empty($date)) {
            return $default;
        }

        $format =
            self::get(
                'date_format',
                'd M Y'
            );

        try {

            $dateTime =
                new DateTime(
                    $date,
                    new DateTimeZone(
                        self::getTimezone()
                    )
                );

            return $dateTime->format($format);

        } catch (Throwable $e) {

            return $default;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | FORMAT TIME
    |--------------------------------------------------------------------------
    */

    public static function formatTime(
        $time,
        $default = null
    ) {
        if (empty($time)) {
            return $default;
        }

        $format =
            self::get(
                'time_format',
                'h:i A'
            );

        try {

            $dateTime =
                new DateTime(
                    $time,
                    new DateTimeZone(
                        self::getTimezone()
                    )
                );

            return $dateTime->format($format);

        } catch (Throwable $e) {

            return $default;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | CURRENT DATE/TIME
    |--------------------------------------------------------------------------
    */

    public static function now()
    {
        return new DateTime(
            'now',
            new DateTimeZone(
                self::getTimezone()
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CURRENT DATE
    |--------------------------------------------------------------------------
    */

    public static function currentDate()
    {
        $dateTime =
            self::now();

        $format =
            self::get(
                'date_format',
                'd M Y'
            );

        return $dateTime->format($format);
    }


    /*
    |--------------------------------------------------------------------------
    | CURRENT TIME
    |--------------------------------------------------------------------------
    */

    public static function currentTime()
    {
        $dateTime =
            self::now();

        $format =
            self::get(
                'time_format',
                'h:i A'
            );

        return $dateTime->format($format);
    }


    /*
    |--------------------------------------------------------------------------
    | CURRENT DATE + TIME
    |--------------------------------------------------------------------------
    */

    public static function currentDateTime()
    {
        return self::currentDate()
            . ' ' .
            self::currentTime();
    }


    /*
    |--------------------------------------------------------------------------
    | FORMAT DATE + TIME
    |--------------------------------------------------------------------------
    */

    public static function formatDateTime(
        $datetime,
        $default = null
    ) {
        if (empty($datetime)) {
            return $default;
        }

        try {

            $dateTime =
                new DateTime(
                    $datetime,
                    new DateTimeZone(
                        self::getTimezone()
                    )
                );

            $dateFormat =
                self::get(
                    'date_format',
                    'd M Y'
                );

            $timeFormat =
                self::get(
                    'time_format',
                    'h:i A'
                );

            return $dateTime->format(
                $dateFormat .
                ' ' .
                $timeFormat
            );

        } catch (Throwable $e) {

            return $default;
        }
    }
}