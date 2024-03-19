<?php

class RegisterController extends Controller{
    public function index(){
        $error = [];
        try{
            if(isset($_POST["register"])){
                $user = new User($_POST["username"], $_POST["password"], $_POST["firstName"], $_POST["lastName"]);
                User::insertIntoUser($user);
                $this->redirect("/login");
            }
        }
        catch(PDOException|Exception $e){
            if($e->getCode() === 1)
                $error["form"] = $e->getMessage();
            else
                $error["db"] = $e->getMessage();
        }
        require("../views/register.php");
    }
}