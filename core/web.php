<?php
// route registery
Router::get("", function() {
    include "views/home.php";
});

Router::get("user", function() {
    $userController = new UserController;
    $user = $userController->getUser($_SESSION["username"]);
    include "views/user.php";
});

Router::get("poll", function() {
    $userController = new UserController;
    include "views/poll.php";
});

Router::get("poll/create", function() {
    include "views/poll/create.php";
});

Router::get("user/login", function() {
    include "views/login.php";
});

Router::get("user/logout", function() {
    include "views/logout.php";
});

Router::post("user/create", function() {
    $userController = new UserController;
    $file = $_FILES['img'];
    $userController->create($_POST, $file);
});

Router::post("user/login", function() {
    $userController = new UserController;
    $userController->login($_POST);
});

if(Router::$found === false) {
    include "views/_404.php";
}