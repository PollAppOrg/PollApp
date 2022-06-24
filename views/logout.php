<?php
// session_start();
$_SESSION = [];
session_destroy();
session_start();
Router::redirect("user/login");