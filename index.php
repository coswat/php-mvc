<?php
require 'loader.php';
use App\Router as Route;


Route::get('/',function(){
  return 'hello';
});

Route::get('/hello',function (){
  return 'hello from hello';
});

echo Route::run($_SERVER['REQUEST_URI']);
