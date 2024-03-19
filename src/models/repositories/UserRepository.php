<?php
class UserRepository extends Db{
    private static function request($query){
        return self::getInstance()->query($query);
    }

    public static function getUsers(){
        return self::request("SELECT * FROM user")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUserById($id){
        return self::request("SELECT * FROM user WHERE id=$id")->fetch(PDO::FETCH_ASSOC);
    }

    public static function getUserByUsername($username){
        return self::request("SELECT * FROM user WHERE username='$username'")->fetch(PDO::FETCH_ASSOC);
    }

    public static function insertIntoUser(User $user){
        return self::request("INSERT INTO user(username, password, firstName, lastName) VALUES ('" . $user->getUsername() . "','" . $user->getPassword() . "','" . $user->getFirstName() . "','" . $user->getLastName() . "')");
    }
}