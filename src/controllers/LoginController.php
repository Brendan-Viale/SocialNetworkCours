<?php
//Controller de ma page Login
class LoginController extends Controller{
  //Contiendra tous les messages d'erreur
  private static $errors = [];

  //Getter de mon attribut $errors
  public static function getErrors(){
    return self::$errors;
  }
  
  //Affiche et gère la logique de la page
  public function index(){
    $request = $_SERVER["REQUEST_METHOD"];
    //Si l'utilisateur a cliqué sur un input de type submit sur ma page
    if($request === "POST"){
      //Récupère l'utilisateur dans ma base de données grâce au username donné par l'internaute
      $userFromDb = User::findBy("username",$_POST['username']);
      //Si j'ai bien trouvé l'utilisateur dans ma base de données
      if($userFromDb !== []){
        //Je vérifie que les mots de passe correspondent
        if($userFromDb[0]["password"] === $_POST['password']){
          //Si ils correspondent, je stocke l'id de l'utilisateur trouvé dans la superglobale $_SESSION (variable accessible depuis tout le site, donc sur toutes les pages)
          session_start();
          $_SESSION['id_connected_user'] = $userFromDb[0]["id"];
          //Je redirige l'utilisateur sur la page d'accueil
          $this->redirect("/");
        }
        //Si les mots de passe ne concordent pas, je stocke le message d'erreur dans ma variable $errors
        else{
          self::$errors["password"] = "Le mot de passe ne correspond pas à l'utilisateur";
        }
      }
      //Si je n'ai pas trouvé l'utilisateur dans ma base de données, je stocke le message d'erreur dans ma variable $errors
      else{
        self::$errors["username"] = "Le username n'existe pas dans ma base de données";
      }
    }
    //J'affiche le code html de ma page en important la view
    require(__DIR__ . "/../../views/login.php");
  }
}
?>