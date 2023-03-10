<?php

declare(strict_types=1);

namespace Core;

class View
{
    private static string $file;
    private static array $var;

    public static function render(string $view, array $data = [])
    {
        $viewFile = $view . ".view.php";
        self::$file = PATH . "/app/views/" . $viewFile;
        self::$var = $data;

        if (file_exists(self::$file)) {
            return self::loadFile();
        }
    }

    private static function loadFile(): void
    {
        if (empty(self::$var)) {
            require_once self::$file;
        } else {
            foreach (self::$var as $key => $value) {
                $$key = $value;
            }

            require_once self::$file;
        }
    }
}
