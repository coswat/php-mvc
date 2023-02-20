<?php
declare(strict_types=1);
namespace App;

class View {
  
  private static string $file;
  private static array $var;
  public static function render(string $view,array $data = []): ?string
  {
    $viewFile = $view.'.view.php';
    self::$file = PATH.'/views/'.$viewFile;
    
    if(file_exists(self::$file))
    {
      self::$var = $data;
      return self::loadFile();
    }else{
      return "{$viewFile} not found";
    }
  }
  
  private static function loadFile(): void
  {
    if(empty(self::$var))
    {
      include self::$file;
 
    }else{
      
    foreach(self::$var as $key => $value)
    {
      $$key = $value;
    }
    include self::$file;
    
    }
  
  }
  
}