<?php
session_start();
require("../src/models/Db.php");
require("../src/models/repositories/UserRepository.php");
require("../src/models/User.php");
require("../src/models/repositories/PostRepository.php");
require("../src/models/Post.php");
require("../src/controller/Controller.php");
require("../src/controller/MainController.php");
require("../src/controller/LoginController.php");
require("../src/controller/RegisterController.php");
require("../core/Router.php");
$router = new Router();
$router->start();
