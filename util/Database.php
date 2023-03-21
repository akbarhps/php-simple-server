<?php

class Database
{
    private static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance($config)
    {
        if (self::$instance === null) {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // error reporting
            self::$instance = mysqli_connect(
                $config['db_host'],
                $config['db_username'],
                $config['db_password'],
                $config['db_name']
            );
            self::$instance->set_charset('utf8mb4');
        }

        return self::$instance;
    }

}