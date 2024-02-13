<?php
    class Db {
        private static $instance = NULL;

        private function __construct() {}
        private function __clone() {}

        public static function getInstance() {
            if(!isset(self::$instance)) {
                self::$instance = new PDO("mysql:host=localhost;dbname=herewego;charset=utf8", "root", "",[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
            }
            return self::$instance;
        }
    }
?>