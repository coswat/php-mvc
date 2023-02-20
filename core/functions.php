<?php
declare(strict_types=1);
use App\View;
use App\Router as Route;

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