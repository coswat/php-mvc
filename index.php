<?php
define("PATH", __DIR__);
require "loader.php";

use App\Router as Route;
use App\Controllers\TestController;
use App\View;

Route::get("/", function () {
    return "Hello World";
});

Route::get("/hello", function () {
    return "hello";
});

Route::get("/test", [TestController::class, "store"]);
Route::get('/help',function(){
  return 'hi';
});

Route::get('/testgc',[TestController::class,'post']);


echo runRoutes();