<?php

define('HOST', 'localhost');
define('DBNAME', 'sys');
define('USER', 'root');
define('PASSWORD', '');


final class Connection
{
    private static $pdo = null;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (!isset(self::$pdo)) {
            try {
                $connection = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => true);
                self::$pdo = new PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . ";", USER, PASSWORD, $connection);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        return self::$pdo;
    }
}


?>