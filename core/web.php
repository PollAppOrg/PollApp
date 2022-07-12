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
    $voteController = new VoteController;

    $votes = $voteController->fetchVotes($_SESSION['user_id'] );
    // var_dump($votes);
    // var_dump($voteController->isVoted($_SESSION['user_id'],1));
    $poll = $pollController->getPolls($voteController);
});

Router::get("poll/get/{id}", function($id) {
    if($_SESSION['logged_in']) {
        $pollController = new PollController;
        $voteController = new VoteController;
        $pollController->getPoll($id, $voteController->isVoted($_SESSION['user_id'],$id));
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
    var_dump($_POST);
    $pollController = new PollController;
    $pollController->update($_POST);
});

Router::post("poll/delete", function() {
    // var_dump("here");
    $pollController = new PollController;
    $voteController = new VoteController;
    if($pollController->delete($_POST))
        $voteController->deleteVotes($_POST['id']);
});

Router::get("poll/search", function() {
    $pollController = new PollController;
    if(!isset($_GET['value']) || empty($_GET['value'])) {
        Router::redirect('poll');
    } else {
        $pollController->searchAndGetPolls($_GET['value']);
    }
});

Router::get("poll/trending", function() {
    // var_dump("here");
    $pollController = new PollController;
    $polls = $pollController->getTrendingPolls();
    echo json_encode($polls);
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
    $voteController = new VoteController;
    if($pollController->vote($_POST))
        $voteController->createVote($_SESSION['user_id'], $_POST['id']);
});

if(Router::$found === false) {
    include "views/_404.php";
}