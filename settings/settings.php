<?php
const SETTINGS = [
    "db" => [
        "host"     => getenv('MYSQLHOST') ?: "localhost",
        "dbname"   => getenv('MYSQLDATABASE') ?: "vhWebshop",
        "user"     => getenv('MYSQLUSER') ?: "root",
        "password" => getenv('MYSQLPASSWORD') ?: "",
        "port"     => getenv('MYSQLPORT') ?: "3306",
    ]
];