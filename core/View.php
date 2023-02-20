<?php
declare(strict_types=1);
namespace App;

class View {
  
  private static $file;
  
  public static function render(string $view,array $data = [])
  {
    $viewFile = $view.'.view.php';
    self::$file = PATH.'/views/'.$viewFile;
    if(file_exists(self::$file))
    {
      include self::$file;
    }else{
      return "{$viewFile} not found";
    }
  }
  
}