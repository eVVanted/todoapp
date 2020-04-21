<?php
namespace MyApp\classes;

class DB extends \mysqli
{

    private static $host = '127.0.0.1';
    private static $user = 'root';
    private static $pass = '';
    private static $db_name = 'todolist';
    private static $instance = null;

    public function __construct() {
        parent::__construct(self::$host, self:: $user, self::$pass, self::$db_name);
        if( mysqli_connect_errno() ) {
            throw new \Exception(mysqli_connect_error(), mysqli_connect_errno());
        }
    }

    private function __clone() {}
    private function __wakeup () {}

    public static function getConnection() {
        if( !self::$instance ) {
            self::$instance = new self();
            self::$instance->set_charset('utf8');
            self::$instance->character_set_name();
            self::$instance->query("SET CHARACTER SET utf8");
        }
        return self::$instance;
    }

}
