<?php
//Gère la page register
class RegisterController extends Controller{
    public function index(){
        //Si l'utilisateur a cliqué sur le bouton Submit de la page
        $request = $_SERVER["REQUEST_METHOD"];
        if($request === "POST"){
            //Si les mots de passe concordent (mdp et mdp vérification)
            if($_POST["password_validation"] === $_POST["password"]){
                try{
                    //Comme dans MainController, je récupère l'id du dernier User de ma base de données, et je l'incrémente afin de gérer la contrainte AUTO_INCREMENT de ma db
                    $users = User::findAll();
                    //Je crée mon user depuis tous les champs renseignés dans le formulaire
                    $user = new User($users[count($users)-1]['id'] + 1,$_POST["username"],$_POST['password'],$_POST['firstname'],$_POST['lastname']);
                    //J'insère dans ma base de données l'utilisateur créé
                    $user->insertIntoDb();
                }
                catch(Exception $e){
                    die($e->getMessage());
                }
                //Si tout s'est bien passé, je redirige vers la page Login afin que l'utilisateur se connecte
                $this->redirect("/login");
            }
            //Si les mots de passe ne concordent pas, affiche le message d'erreur
            else echo "Les mots de passe ne concordent pas";
        }
        //J'affiche la view register.php
        require(__DIR__ . "/../../views/register.php");
    }
}
?>