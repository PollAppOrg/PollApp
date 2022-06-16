<?php

include "core/init.php";

define('ROOT', substr($_SERVER['PHP_SELF'], 0, -9));
define('PUBLIC_ROOT', ROOT . "public/");

include "core/web.php";
