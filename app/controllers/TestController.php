<?php
namespace App\Controllers;
use Core\View;
class TestController extends View
{
    public function store()
    {
        /* note for using layout you need to extend the controller to View and need to add self::$layout = 'layout name' if don't have layout then no need to add this*/

        self::$layout = "base";
        return view("test", [
            "data" => "Hello From Test Controller + Post Route",
        ]);
    }
}
