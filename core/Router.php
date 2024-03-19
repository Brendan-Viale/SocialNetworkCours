<?php
class Router{
    public function start(){
        $url = $_SERVER["REQUEST_URI"];
        if($url==="/"){
            $accueil = new MainController();
            $accueil->index();
        }
        else{
            $className = ucfirst(explode("/",$url)[1]) . "Controller";
            if(class_exists($className)){
                $controller = new $className();
                if(method_exists($controller, "index"))
                    $controller->index();
                else
                    echo "Merci d'implémenter la méthode index";
            }
            else{
                echo "Error 404 : not found";
            }
        }
    }
}