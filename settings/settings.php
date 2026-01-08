<?php
define('SETTINGS', [
    "db" => [
        "host"     => getenv('MYSQLHOST'),
        "dbname"   => getenv('MYSQLDATABASE'),
        "user"     => getenv('MYSQLUSER'),
        "password" => getenv('MYSQLPASSWORD'),
        "port"     => getenv('MYSQLPORT') ?: "3306",
    ]
]);

if (isset($_GET['debug_db'])) {
    echo "Host: " . SETTINGS['db']['host'] . "<br>";
    echo "Database: " . SETTINGS['db']['dbname'];
    exit();
}