<?php
define('SITENAME', 'fastride');
define('SITE_ROOT', 'http://' . $_SERVER["HTTP_HOST"] . '/' . SITENAME . '/');
define('DATABASE_HOST', 'localhost');
define("DATABASE_USER", "root");
define("DATABASE_PASSWORD", "");
define("DATABASE_NAME", SITENAME);
define('DB_CONNECTION',   new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME));
define('SMTP_EMAIL', '********');
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_AUTH', true);
define('SMTP_USERNAME', '*******');
define('SMTP_PASSWORD', '********');
define('SMTP_SECURITY', 'tls');
define('SMTP_PORT', 587);
