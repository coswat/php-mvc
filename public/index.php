<?php

define('APP_START',microtime(true));
define("PATH", __DIR__.'/../');

require __DIR__ . "/../vendor/autoload.php";

require PATH.'routes/web.php';

echo runRoutes();