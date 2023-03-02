<?php

define("PATH", __DIR__.'/../');
require __DIR__ . "/../vendor/autoload.php";

use Core\Router as Route;
use App\Controllers\TestController;
use Core\View;

/*Routes Pages here you can set route, supported methods GET and POST only examples route are given below, available functions abort(int status code) this will return the status code and show the 404 page from app/views/errors/code.php 404 is set as default,
second function route(string name) if you set route a name , this function will return its url, third function is view(string name) this will load the view file from app/view/name.view.php 

Note : layouts only works in returinig view from controller, more features add soon*/

Route::get("/", function () {
    return view("welcome");
})->name("home");

Route::get("/test", function () {
    return "hello";
});

Route::post("/post", [TestController::class, "store"])->name("post");

Route::get("/abort", function () {
    return abort(404);
});

echo runRoutes();

if(class_exists(TestController::class))
{
  echo  "available";
}
else {
   echo "not available";
}