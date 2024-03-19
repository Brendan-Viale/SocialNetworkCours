<?php
class LoginController extends Controller{
    public function index(){
        try{
            if(isset($_POST["login"])){
                $user = User::getUserByUsername(htmlspecialchars($_POST["username"]));
                if(!$user){
                    throw new Exception("Aucun utilisateur trouvé à ce username",2); 
                }
                else{
                    if($user["password"] === htmlspecialchars($_POST["password"])){
                        $_SESSION["user"] = $user["id"];
                        $this->redirect("/");
                    }
                    else throw new Exception("Mauvais mot de passe",2);
                }
            }
        }
        catch(PDOException|Exception $e){
            echo $e->getMessage();
        }
        require("../views/login.php");
    }
}