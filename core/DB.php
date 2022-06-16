<?php

class DB {
    private static $conn;
    private static $instance = null;

    private function __construct()
    {
        
    }
    public static function getInstance() {
        if(is_null(self::$instance)) {
            self::$instance =  new DB;
        }
        return self::$instance;
    }

    public static function connect($host, $user, $pw, $db) {
        self::$conn = new mysqli($host, $user, $pw, $db);
    }

    public static function getConn() {
        return self::$conn;
    }

}