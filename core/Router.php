<?php
declare(strict_types=1);

namespace Core;

class Router
{
    private static array $params;
    public static string $name;
    public static array $names;

    public static function get(string $route, callable|array $action): self
    {
        self::$name = $route;
        self::$params[$route]["GET"] = $action;
        return new static();
    }
    public static function post(string $route, callable|array $action): self
    {
        self::$name = $route;
        self::$params[$route]["POST"] = $action;
        return new static();
    }
    public static function put(string $route, callable|array $action): self
    {
        self::$name = $route;
        self::$params[$route]["PUT"] = $action;
        return new static();
    }
    public static function patch(string $route, callable|array $action): self
    {
        self::$name = $route;
        self::$params[$route]["PATCH"] = $action;
        return new static();
    }
    public static function delete(string $route, callable|array $action): self
    {
        self::$name = $route;
        self::$params[$route]["DELETE"] = $action;
        return new static();
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
    public static function name(string $name): void
    {
        self::$names[$name] = self::$name;
    }
}
