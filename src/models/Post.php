<?php
class Post extends PostRepository{
    private $id;
    private $title;
    private $content;
    private $idUser;

    public function __construct($title, $content, $idUser, $id=null){
        $this->id = $id;
        $this->setTitle($title);
        $this->setContent($content);
        $this->setIdUser($idUser);
    }

    public function getId(){return $this->id;}

    public function getTitle(){return $this->title;}
    public function setTitle($title){
        $this->title = htmlspecialchars($title);
    }

    public function getContent(){return $this->content;}
    public function setContent($content){
        $this->content = htmlspecialchars($content);
    }

    public function getIdUser(){return $this->idUser;}
    public function setIdUser($idUser){
        $this->idUser = htmlspecialchars($idUser);
    }
}