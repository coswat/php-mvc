<?php
define("PATH", __DIR__.'/../');
require __DIR__ . "/../vendor/autoload.php";

require PATH.'routes/web.php';

echo runRoutes();