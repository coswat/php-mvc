<?php
declare(strict_types=1);
namespace Core;

class View
{
    private static string $file;
    private static array $var;
    public static string $layout = "";

    public static function render(string $view, array $data = [])
    {
        $viewFile = $view . ".view.php";
        self::$file = PATH . "/app/views/" . $viewFile;
        self::$var = $data;

        if (!self::$layout && file_exists(self::$file)) {
            return self::loadFile();
        }
        $layoutPath =
            PATH . "/app/views/layouts/" . self::$layout . ".view.php";

        if (file_exists($layoutPath)) {
            self::loadLayout($layoutPath);
        } else {
            return "layout not found";
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

    private static function loadLayout(string $layoutPath): void
    {
        if (empty(self::$var)) {
            $yeidfile = self::$file;
            require_once $layoutPath;
        } else {
            foreach (self::$var as $key => $value) {
                $$key = $value;
            }
            $yeidfile = self::$file;
            require_once $layoutPath;
        }
    }
}
