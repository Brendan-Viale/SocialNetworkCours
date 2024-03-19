<?php
class MainController extends Controller{
    public function index(){
        if(isset($_POST["disconnect"])){
            session_destroy();
            $this->redirect("/login");
        }
        elseif(isset($_POST["delete"])){
            Post::delete($_POST["delete"]);
        }
        elseif(isset($_POST["create"])){
            $post = new Post($_POST["title"], $_POST["content"], $_SESSION["user"]);
            Post::insertIntoPost($post);
        }
        elseif(isset($_POST["confirm"])){
            $post = new Post($_POST["title"], $_POST["content"], $_SESSION["user"], $_POST["confirm"]);
            Post::update($post);
        }
        
        $posts = Post::getPosts();
        require("../views/main.php");
    }
}