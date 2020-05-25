<?php
require_once('./modele/config/config.php');
class Database
{
    private static $instance = null;

    private function _construct(){}
    //Création d'une connexion avec la base de donnée.
    public static function getInstance()
    {
        if(self::$instance == null) {
            self::$instance = new PDO(
                "mysql:host=".Config::DB_HOST.";dbname=".Config::DB_NAME."",
                Config::DB_USER,
                Config::DB_PWD,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'));
        }
        return self::$instance;
    }
}
?>