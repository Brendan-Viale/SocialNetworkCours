<?php

//Création de notre classe Post afin de rajouter une couche de protection à nos données
class Post extends Model{
    //Cette variable permettra de stocker l'entièreté des posts existants
    private static $posts = array();
    private $id;
    private $title;
    private $content;
    private $idUser;
    //Création de notre post, on a besoin de l'id, du titre, du contenu et de l'id de l'auteur
    public function __construct($id, $title, $content, $idUser){
      $this->id = htmlspecialchars($id);
      $this->setTitle($title);
      $this->setContent($content);
      $this->setIdUser($idUser);
      $this->table="post";
      $this->columns = ["id","Title","Content","User_idUser"];
      Post::$posts[] = $this;
    }
    //Accesseurs et Mutateurs
    public function getId(){ return $this->id; }

    public function setTitle($title){
      $this->title = htmlspecialchars($title);
    }
    public function getTitle(){ return $this->title; }

    public function setContent($content){
      $this->content = htmlspecialchars($content);
    }
    public function getContent(){ return $this->content; }

    public function setIdUser($idUser){
      $this->idUser = htmlspecialchars($idUser);
    }
    public function getIdUser(){ return $this->idUser; }

    public function getAttributes(){
        return array($this->id, $this->title, $this->content, $this->idUser);
    }

    public function getColumns(){
        return ["id","Title","Content","User_idUser"];
    }
    
    //Récupère l'entièreté des posts sous forme de tableau d'objets
    public static function getPosts(){ 
      return self::$posts;
    }

    // Renvoie le post correspondant à l'id donné
    public static function getPost($id){
      foreach(self::$posts as $post){
        if($post->getId() === $id)
          return $post;
      }
      throw "Post not found";
    }
}

