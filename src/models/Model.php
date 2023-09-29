<?php
//Classe abstraite car on ne doit pas pouvoir créer d'objets de la classe Model
abstract class Model extends Db{
    protected string $table;
    protected $columns = [];
    //Exécute la requête, quelle qu'elle soit
    //Je dois mettre la fonction en static parce qu'elle est appelée depuis les méthodes statiques findAll() et findById()
    public static function executeRequest(string $request){
        //Je me connecte à la db et j'exécute la requête
        $result = self::getInstance()->query($request);
        //Je me déconnecte de la db
        self::disconnect();
        //Je retourne le résultat de la requête
        return $result;
    }

    //Récupère l'entièreté des entrées de la classe dans la db 
    public static function findAll(){
        //Requête SQL - Je récupère le nom de la classe qui m'appelle en lettres minuscules
        //Exemple : User::findAll(), j'aurai donc "user"
        $request = "SELECT * FROM " . strtolower(get_called_class());
        //On récupère le résultat et on le convertit en tableau associatif
        return self::executeRequest($request)->fetchAll(PDO::FETCH_ASSOC);
    }

    //Récupère l'entrée selon l'id donné en paramètre
    public static function findById($id){
        //Requête SQL - Je récupère le nom de la classe qui m'appelle en lettres minuscules
        //Exemple : User::findAll(), j'aurai donc "user"
        $request = "SELECT * FROM " . strtolower(get_called_class()) . " WHERE id=$id";
        //On récupère le résultat et on le convertit en tableau associatif
        return self::executeRequest($request)->fetchAll(PDO::FETCH_ASSOC);
    }

    //Renvoie une entrée par une condition WHERE utilisant une autre colonne que l'id
    public static function findBy($column,$value){
        //Si la valeur est une chaine de caractère, on rajoute les '
        if(is_string($value))
            $request = "SELECT * FROM " . strtolower(get_called_class()) . " WHERE " . $column . "='" . $value . "'";
        else
            $request = "SELECT * FROM " . strtolower(get_called_class()) . " WHERE " . $column . "=" . $value;
        //On exécute la requête
        return self::executeRequest($request)->fetchAll(PDO::FETCH_ASSOC);
    }

    //Supprime l'entrée dans la base de donnée de l'objet qui appelle la fonction
    //Exemple : $user->deleteFromDb() supprimera l'entrée qui a la même id que $user
    public function deleteFromDb(){
        //Requête SQL
        $request = "DELETE FROM " . $this->table . " WHERE id=" . $this->getId();
        //Exécute la requête
        return self::executeRequest($request);
    }

    //Insère l'objet dans la base de données
    public function insertIntoDb(){
        $goodValues = [];
        //On récupère tous les attributs de notre classe (User ou Post) dans un tableau
        foreach($this->getAttributes() as $value){
            //Si la valeur est de type string
            if(is_string($value) === true)
                //On la récupère entourée de ' afin que cela soit considéré comme des strings par la bdd
                array_push($goodValues,"'" . $value . "'");
            else
                //Sinon on rajoute la donnée telle quelle
                array_push($goodValues,$value);
        }
        //On écrit la requête SQL, implode me permet d'afficher mon tableau sous forme "valeur1, valeur2, valeur3, ..."
        $request = "INSERT INTO " . $this->table . " VALUES(" . implode(",",$goodValues) . ")";
        //On exécute la requête
        return self::executeRequest($request);
    }

    //Permet d'update l'objet qui appelle la fonction dans la base de données
    //Exemple : $user->update()
    public function updateDb(){
        //Contiendra les valeurs de ma table dans le format que souhaite SQL
        $goodValues = [];
        //Pour chaque colonne dans ma base de données
        for($i=0 ; $i<count($this->getColumns()) ; $i++){
            //Si la valeur associée est un string, j'ajoute des "'" autour
            if(is_string($this->getAttributes()[$i]))
                //J'insère dans mon tableau $goodValues une ligne au format "colonne='valeur'"
                array_push($goodValues,$this->getColumns()[$i] . "='" . $this->getAttributes()[$i] . "'");
            //S'il ne s'agit pas d'un string
            else
                //J'insère dans mon tableau $goodValues une ligne au format "colonne=valeur"
                array_push($goodValues,$this->getColumns()[$i] . "=" . $this->getAttributes()[$i]);
        }
        //J'écris la requête qui ressemblera à "UPDATE table SET colonne1=valeur1, colonne2=valeur2 ..."
        $request = "UPDATE " . $this->table . " SET " . implode(",",$goodValues) . " WHERE id=" . $this->getId();
        //J'exécute ma requête
        return self::executeRequest($request);
    }
    
    //Les enfants de Model seront obligés d'écrire les fonctions getColumns() et getAttributes()
    abstract public function getColumns();
    abstract public function getAttributes();
    abstract public function getId();
}
?>  