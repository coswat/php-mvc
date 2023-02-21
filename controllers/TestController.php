<?php
namespace App\Controllers;

class TestController
{
    public function store()
    {
        return view("test", [
            "name" => "coderswat",
            "github" => "https://github.com/coswat",
        ]);
    }
}
