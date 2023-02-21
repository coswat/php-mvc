<?php

define("PATH", __DIR__);
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/core/functions.php';

use Core\Router as Route;
use App\Controllers\TestController;
use Core\View;

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