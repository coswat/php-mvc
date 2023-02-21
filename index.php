<?php
define("PATH", __DIR__);
require "loader.php";

use App\Router as Route;
use App\Controllers\TestController;
use App\View;

Route::get("/", function () {
    return view('home');
});

Route::post('/post',function(){
  return 'hello from post route';
});

Route::get("/test", [TestController::class, "store"]);

Route::get('/abort',function(){
  return abort(404);
});

echo runRoutes();