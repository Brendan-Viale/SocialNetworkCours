<?php
class Db{
    private static $instance = null;

    protected static function getInstance(){
        if(self::$instance === null){
            self::$instance = new PDO("mysql:host=localhost;dbname=social_network_cours",'root','');
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }

    protected static function disconnect(){
        self::$instance = null;
    }
}