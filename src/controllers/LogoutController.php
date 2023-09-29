<?php
    //Gère la déconnexion
    class LogoutController extends Controller{
        public function index(){
            //On détruit la variable $_SESSION qui stockait l'id de l'utilisateur connecté
            session_start();
            $_SESSION['id_connected_user'] = null;
            session_destroy();
            //On redirige vers la page de Login
            $this->redirect("/login");
        }
    }
?>