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
    $pollController = new PollController;
    $poll = $pollController->getPolls();
});

Router::get("poll/get/{id}", function($id) {
    if($_SESSION['logged_in']) {
        $pollController = new PollController;
        $pollController->getPoll($id);
    } else {
        include "views/inc/login_redirect.php";
    }
});

Router::get("poll/create", function() {
    include "views/poll/create.php";
});

Router::post("poll/create", function() {
    $pollController = new PollController;
    $file = $_FILES['img'];
    $pollController->create($_POST, $file);
});

Router::post("poll/update", function() {
    $pollController = new PollController;
    $pollController->update($_POST);
});

Router::post("poll/delete", function() {
    // var_dump("here");
    $pollController = new PollController;
    $pollController->delete($_POST);
});

Router::get("poll/search", function() {
    $pollController = new PollController;
    if(!isset($_GET['value']) || empty($_GET['value'])) {
        Router::redirect('poll');
    } else {
        $pollController->searchAndGetPolls($_GET['value']);
    }
});

Router::get("user/signup", function() {
    include "views/sign_up.php";
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

Router::post("poll/vote", function() {
    $pollController = new PollController;
    $pollController->vote($_POST);
});

if(Router::$found === false) {
    include "views/_404.php";
}