<?php
class Db{
    private static $conn;
    public static function getConnection(){
        include_once(__DIR__."/../settings/settings.php");
        if(self::$conn == null){ 
            $dsn = 'mysql:host=' . SETTINGS['db']['host'] . 
                   ';port=' . SETTINGS['db']['port'] . 
                   ';dbname=' . SETTINGS['db']['dbname'];

            try {
                self::$conn = new PDO($dsn, SETTINGS['db']['user'], SETTINGS['db']['password']);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return self::$conn;
            } catch (PDOException $e) {
                die("Connectie mislukt: " . $e->getMessage());
            }
        } else {
            return self::$conn;
        }
}};