<?php
//J'importe tous mes Controller et tous mes Model
require_once(__DIR__ . "/../src/models/Db.php");
require_once(__DIR__ . "/../src/models/Model.php");
require_once(__DIR__ . "/../src/models/Post.php");
require_once(__DIR__ . "/../src/models/User.php");
require_once(__DIR__ . "/../src/controllers/Controller.php");
require_once(__DIR__ . "/../src/controllers/LoginController.php");
require_once(__DIR__ . "/../src/controllers/LogoutController.php");
require_once(__DIR__ . "/../src/controllers/MainController.php");
require_once(__DIR__ . "/../src/controllers/RegisterController.php");
require_once(__DIR__ . "/../core/MainApp.php");

try{
    //Je crée un objet de mon routeur
   $app = new MainApp();
   //J'appelle la fonction qui gère les routes (donc qui renvoie l'utilisateur vers le bon controller)
   $app->start();
}
catch(PDOException $e){
    die($e->getMessage());
}

?>