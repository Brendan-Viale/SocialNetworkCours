<?php
//Création de notre classe Post afin de rajouter une couche de protection à nos données
class User extends Model{
  //Cette variable permettra de stocker l'entièreté des posts existants
  private static $users = array();
  private $id;
  private $username;
  private $password;
  private $firstName;
  private $lastName;
  //Création de notre post, on a besoin de l'id, du titre, du contenu et de l'id de l'auteur
  public function __construct($id, $username, $password, $firstName, $lastName){
    $this->id=htmlspecialchars($id);
    $this->setUsername($username);
    $this->setPassword($password);
    $this->setFirstName($firstName);
    $this->setLastName($lastName);
    User::$users[] = $this;
    $this->table="user";
    $this->columns = ["id","username","password","firstName","lastName"];
  }

  public static function getUsers(){
    return self::$users;
  }
  //Accesseurs et Mutateurs
  public function getId(){ return $this->id; }

  public function setUsername($username){ $this->username = htmlspecialchars($username); }
  public function getUsername(){ return $this->username; }

  public function setPassword($password){ $this->password = htmlspecialchars($password); }
  public function getPassword(){ return $this->password; }

  public function setFirstName($firstName){ $this->firstName = htmlspecialchars($firstName); }
  public function getFirstName(){ return $this->firstName; }

  public function setLastName($lastName){ $this->lastName = htmlspecialchars($lastName); }
  public function getLastName(){ return $this->lastName; }

  public function getAttributes(){
    return [$this->id, $this->username, $this->password, $this->firstName, $this->lastName];
  }

  public function getColumns(){
    return ["id","username","password","firstName","lastName"];
  }
}