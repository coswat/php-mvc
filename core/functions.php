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
       $method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
    return Route::run($_SERVER["REQUEST_URI"], $method);
}
function abort(int $code = 404)
{
    $file = PATH . "/app/views/errors/" . $code . ".view.php";
    if (file_exists($file)) {
        http_response_code($code);
        require_once $file;
    } else {
        return "file not found";
    }
}
function route(string $key): string
{
    $array = Route::$names;
    if (array_key_exists($key, $array)) {
        return Route::$names[$key];
    } else {
        return "not found";
    }
}
function asset(string $file): string
{
    return "/asset/" . $file;
}
function method(string $method): string
{
  return '<input type="hidden" name="_method" value="'.$method.'"/>';
}