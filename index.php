<?php
require 'loader.php';

use App\Router as Route;
use App\Controllers\TestController;
use App\View;
Route::get('/',function(){
  return 'hello';
});

Route::get('/hello',function (){
  return 'hello from hello';
});

Route::get('/test',[TestController::class,'store']);

echo Route::run($_SERVER['REQUEST_URI']);
