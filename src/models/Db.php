<?php 
//On crée une classe Db afin de pouvoir effectuer des requêtes à l'intérieur d'autres classes (qui devront donc hériter de Db)
//Sinon, nous devrions créer une variable globale $db qui effectuerait la connexion
class Db{
    //Unique instance de la classe Db
    private static $instance;

    //Permet de récupérer l'instance de la db, on la crée si elle n'existe pas puis on la retourne
    protected static function getInstance(){
        if(self::$instance===null){
            try{
                self::$instance = new PDO("mysql:host=localhost;dbname=social_network_cours","root","");
                self::$instance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
        }
        return self::$instance;
    }

    protected static function disconnect(){
        self::$instance=null;
    }
}
?>