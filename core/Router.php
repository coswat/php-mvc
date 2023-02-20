<?php
declare(strict_types=1);
namespace App;

class Router {
//  private string $uri;
  public static array $params;
  
  public static function get(string $route,callable $action): void
  {
    self::$params[$route] = $action;
    
  }
  
  public static function run($uri): string
  {
    $route = parse_url($uri);
    $action = self::$params[$route['path']] ?? null;
    if(!$action){
      return 'bad request';
    }
   return call_user_func($action);
   
  }
  
}