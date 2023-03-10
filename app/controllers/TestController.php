<?php

namespace App\Controllers;

class TestController
{
    public function store()
    {
        return view("test", [
            "data" => "Hello From Test Controller + Post Route",
        ]);
    }
}
