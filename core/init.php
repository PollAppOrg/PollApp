<?php
ob_start();
// start session
session_start();
if(!isset($_SESSION['logged_in'])) {
    $_SESSION['logged_in'] = false;
    $_SESSION['user_id'] = -1;
}

include_once "core/DB.php";
DB::getInstance();
DB::connect("localhost", "root", "root", "2022PollAppDB"); //pw = "" for XAMP
$conn = DB::getConn();
// auto load classes
spl_autoload_register(function($className) {
    if(file_exists("core/". $className . ".php")) {
        include_once "core/". $className . ".php";
    } elseif(file_exists("controllers/". $className . ".php")) {
        include_once "controllers/". $className . ".php";
    } elseif(file_exists("models/". $className . ".php")) {
        include_once "models/". $className . ".php";
    } elseif(file_exists("middleware/" . $className . ".php")) {
        include_once "middleware/" . $className . ".php";
    } 
});