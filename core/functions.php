<?php
declare(strict_types=1);
use Core\View;
use Core\Router as Route;

function view(string $view, array $data = null): void
{
    if (!empty($data)) {
        View::render($view, $data);
    } else {
        View::render($view);
    }
}

function runRoutes(): ?string
{
    return Route::run($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"]);
}
function abort(int $code = 404): void
{
    $file = PATH . "/app/views/errors/" . $code . ".view.php";
    if (file_exists($file)) {
        http_response_code($code);
        require_once $file;
    } else {
        echo "file not found";
    }
}
function route(string $key)
{
    $array = Route::$names;
    if (array_key_exists($key, $array)) {
        return Route::$names[$key];
    } else {
        return "not found";
    }
}
function asset($file)
{
    return "../asset/" . $file;
}
