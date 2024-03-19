<?php
class PostRepository extends Db{
    private static function request($query){
        return self::getInstance()->query($query);
    }

    public static function getPosts(){
        return self::request("SELECT * FROM post")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getPostById($id){
        return self::request("SELECT * FROM post WHERE id=$id")->fetch(PDO::FETCH_ASSOC);
    }

    public static function getPostByUser($idUser){
        return self::request("SELECT * FROM post WHERE User_idUser='$idUser'")->fetch(PDO::FETCH_ASSOC);
    }

    public static function insertIntoPost(Post $post){
        return self::request("INSERT INTO post(Title, Content, User_idUser) VALUES ('" . $post->getTitle() . "','" . $post->getContent() . "'," . $post->getIdUser() . ")");
    }

    public static function delete($id){
        return self::request("DELETE FROM post WHERE id=$id");
    }

    public static function update(Post $post){
        return self::request("UPDATE post SET Title='" . $post->getTitle() . "', Content='" . $post->getContent() . "' WHERE id=" . $post->getId());
    }
}