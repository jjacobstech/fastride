<?php
error_reporting(0);

class load
{
    public static function customer()
    {
        include_once 'classes/customer.php';
    }

    public static function admin()
    {
        include_once 'classes/admin.php';
    }

    public static function config()
    {
        include_once 'config.php';
    }

    public static function database()
    {
        include_once 'classes/database.php';
    }

    public static function autoloader()
    {
        include_once '../vendor/autoload.php';
    }
}


// error_reporting(0);
