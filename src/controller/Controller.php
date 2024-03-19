<?php
abstract class Controller{
    abstract public function index();

    public function redirect($path){
        header("Location:$path");
        exit();
    }
}