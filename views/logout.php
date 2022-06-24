<?php
// session_start();
$_SESSION = [];
session_destroy();
session_start();
$_SESSION["user_id"] = -1;
Router::redirect("user/login");