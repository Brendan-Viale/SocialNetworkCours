<?php
class User extends UserRepository{
    private $id;
    private $username;
    private $firstName;
    private $lastName;
    private $password;

    public function __construct($username, $password, $firstName, $lastName, $id=null){
        $this->id = $id;
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
    }

    public function getId(){return $this->id;}

    public function getUsername(){return $this->username;}
    public function setUsername($username){
        if(preg_match("/^[A-z]+$/", $username))
            $this->username = htmlspecialchars($username);
        else
            throw new Exception("Mauvais username",1);
    }

    public function getPassword(){return $this->password;}
    public function setPassword($password){
        if(preg_match("/^[A-z0-9\-\!]{3,}$/", $password))
            $this->password = htmlspecialchars($password);
        else
            throw new Exception("Mauvais mot de passe",1);
        
    }

    public function getFirstName(){return $this->firstName;}
    public function setFirstName($firstName){
        if(preg_match("/^[A-z]+$/", $firstName))
            $this->firstName = htmlspecialchars($firstName);
        else
            throw new Exception("Mauvais prénom",1);
    }

    public function getLastName(){return $this->lastName;}
    public function setLastName($lastName){
        if(preg_match("/^[A-z]+$/", $lastName))
            $this->lastName = htmlspecialchars($lastName);
        else
            throw new Exception("Mauvais nom de famille",1);
    }
}