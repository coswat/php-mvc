<?php
namespace App\Controllers;
use Core\View;
class TestController extends View
{
    public function store()
    {
         self::$layout = 'base';
         return view("test",[
           'name' => 'coderswat'
           ]);
    }
}
