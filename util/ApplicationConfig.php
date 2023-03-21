<?php

class ApplicationConfig
{
    private static $config = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function get()
    {
        if (self::$config == null) {
            $path = "./config.json";
            echo $path;
            $jsonString = file_get_contents($path);
            self::$config = json_decode($jsonString, true);
        }

        return self::$config;
    }
}
