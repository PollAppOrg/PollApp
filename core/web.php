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

Router::get("product", function() {
    include "views/product.php";

});

Router::get("product/create", function() {
    include "views/product/create.php";

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
        $file = $_FILES['img'];
        $userController->createUser($_POST, $file);
    } else if (isset($_POST['login'])) {
        $userController->verifyLoginUser($_POST);
    }
});

if(Router::$found === false) {
    include "views/_404.php";
}