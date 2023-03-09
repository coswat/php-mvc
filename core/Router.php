<?php

declare(strict_types=1);

namespace Core;
use App\Middleware\Middleware;

class Router
{
    private static array $routes;
    public static string $name;
    public static array $names;

    public static function setRoutes(
        string $route,
        string $method,
        callable|array $action
    ): void {
        self::$name = $route;
        self::$routes[] = [
            "route" => $route,
            "method" => $method,
            "action" => $action,
            "middleware" => null,
        ];
    }

    public static function get(string $route, callable|array $action): self
    {
        self::setRoutes($route, "GET", $action);
        return new static();
    }
    public static function post(string $route, callable|array $action): self
    {
        self::setRoutes($route, "POST", $action);
        return new static();
    }
    public static function put(string $route, callable|array $action): self
    {
        self::setRoutes($route, "PUT", $action);
        return new static();
    }
    public static function patch(string $route, callable|array $action): self
    {
        self::setRoutes($route, "PATCH", $action);
        return new static();
    }
    public static function delete(string $route, callable|array $action): self
    {
        self::setRoutes($route, "DELETE", $action);
        return new static();
    }
    public static function run($uri, $requestMethod): ?string
    {
        $url = parse_url($uri);

        foreach (self::$routes as $route) {
            if (
                $route["route"] == $url["path"] &&
                $route["method"] == $requestMethod
            ) {
                $action = $route["action"];
                if ($route["middleware"]) {
                    $middleware =
                        Middleware::MAP[$route["middleware"]] ?? false;
                    (new $middleware())->handle();
                }
                if (is_callable($action)) {
                    return self::runCallable($action);
                }
                if (is_array($action)) {
                    return self::runMethod((array) $action);
                }
            }
        }
        return 'bad request';
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
        }
        return "method {$method} not found";
    }
    public static function name(string $name): self
    {
        self::$names[$name] = self::$name;
        return new static();
    }
    public function middleware(string $key): self
    {
        self::$routes[array_key_last(self::$routes)]["middleware"] = $key;
        return new static();
    }
}
