<?php

class DB {

    private static $host = '127.0.0.1';
    private static $user = 'root';
    private static $pass = '';
    private static $db_name = 'todolist';
    private static $db;

    public static function getConnection() {

        if(self::$db === null) {
            $db = new mysqli(self::$host, self:: $user, self::$pass, self::$db_name);
            $db->set_charset('utf8');
            $db->character_set_name();
            $db->query("SET CHARACTER SET utf8");
            if(empty($db->errno)) {
                self::$db = $db;
            }
        }
        return self::$db;
    }

    private function __construct() {}
    private function __clone() {}
}
