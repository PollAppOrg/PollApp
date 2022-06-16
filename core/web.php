<?php
// route registery
Router::get("", function() {
    include "views/home.php";
});

Router::get("login", function() {
    include "views/login.php";
});

Router::get("logout", function() {
    include "views/logout.php";
});

Router::post("login", function() {
    $userController = new UserController;

    if(isset($_POST['create'])) {
        $userController->createUser($_POST);
    } else if (isset($_POST['login'])) {
        $userController->verifyLoginUser($_POST);
    }
});