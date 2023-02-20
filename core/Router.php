<?php
declare(strict_types=1);

namespace App;

class Router
{
    private static array $params;

    public static function get(string $route, callable|array $action): void
    {
        self::$params[$route]['GET'] = $action;
    }
    public static function post(string $route, callable|array $action): void
    {
        self::$params[$route]['POST'] = $action;
    }
    public static function run($uri, $requestMethod): ?string
    {
        $route = parse_url($uri);
        $action = self::$params[$route["path"]][$requestMethod] ?? null;
        if (!$action) {
            return "bad request";
        }
        if (is_callable($action)) {
            return self::runCallable($action);
        }
        if (is_array($action)) {
            return self::runMethod((array) $action);
        }
    }
    private static function runCallable(callable $action): ?string
    {
        return call_user_func($action);
    }

    private static function runMethod(array $action): ?string
    {
        [$class, $method] = $action;
        if (class_exists($class)) {
            $class = new $class();
        } else {
            return "class {$class} not found";
        }
        if (method_exists($class, $method)) {
            return call_user_func_array([$class, $method], []);
        } else {
            return "method {$method} not found";
        }
    }
}
