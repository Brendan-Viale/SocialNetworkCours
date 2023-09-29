<?php

class MainApp{
    //Fonction qui envoie l'utilisateur vers le bon controller
    public function start(){
        //Contient tout ce qu'il y a après le nom de domaine, "/" pour l'accueil
        //Exemple : "/login"
        $url = $_SERVER['REQUEST_URI'];
        //Si l'utilisateur demande une autre page que la page d'accueil
        if($url!=="/"){
            //ucfirst met la 1ère lettre en majuscule, substr($url,1) enlève le "/" au début de la chaîne de caractère
            //On aura donc $controller = "LoginController" ou "LogoutController" ou ...
            $controller = ucfirst(substr($url,1)) . "Controller";
            
            //Si la classe existe bel et bien
            if(class_exists($controller)){
                //On crée un objet du controller de la page que l'on souhaite
                //Exemple : LoginController pour la page /login, RegisterController pour la page /register
                $controllerObject = new $controller();
                //S'il existe une fonction index() dans la classe
                if(method_exists($controllerObject,"index"))
                    //On appelle la fonction index (où sera toute la logique de la page souhaitée)
                    $controllerObject->index();
                //Sinon on affiche un message d'erreur spécifiant que la méthode n'a pas été définie
                else
                    throw new Exception("Aucune méthode index définie dans la classe $controllerObject");
            }
            //Si la classe n'existe pas, on génère une erreur 404 et on affiche le code html de la page 404
            else{
                http_response_code(404);
                require_once(__DIR__ . "/../views/error_404.php");
            }
        }
        //Si l'utilisateur demande la page d'accueil
        else{
            //On lui affiche la page d'accueil
            $controllerObject = new MainController();
            $controllerObject->index();
        }
    }
}

?>