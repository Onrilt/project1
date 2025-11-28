<?php

namespace App;

use Exception;

class Config
{
    private static $config = [];
    private static $loaded = false;
    public static function get($key, $default = null)
    {
        if (!self::$loaded) {
            self::loadConfig();
        }

        return self::getNestedValue(self::$config, $key, $default);
    }

    private static function loadConfig()
    {
        $configFile = './config.php';

        if (!file_exists($configFile)) {
            $file = fopen($configFile, "w");
            if ($file) {
                fwrite($file, file_get_contents('./configExample.txt'));
                fclose($file);
            }

            if (!file_exists($configFile)) {
                throw new Exception("Config file not found: " . $configFile);
            }
        }


        self::$config = require $configFile;
        self::$loaded = true;
    }

    private static function getNestedValue($array, $key, $default = null)
    {
        if (is_null($key)) {
            return $array;
        }

        $keys = explode('.', $key);
        $current = $array;

        foreach ($keys as $segment) {
            if (!is_array($current) || !array_key_exists($segment, $current)) {
                return $default;
            }

            $current = $current[$segment];
        }

        return $current;
    }

    public static function all()
    {
        if (!self::$loaded) {
            self::loadConfig();
        }

        return self::$config;
    }

    public static function has($key)
    {
        if (!self::$loaded) {
            self::loadConfig();
        }

        return self::get($key, '__NOT_FOUND__') !== '__NOT_FOUND__';
    }
}
