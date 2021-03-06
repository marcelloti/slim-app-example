<?php

namespace SlimExample\Modules\Core;

class Helpers {
    public static function pathModules(string $suffix = ''): array {
        $paths = glob(__DIR__.'/../*', GLOB_ONLYDIR);
    
        if ($suffix === ""){
          return $paths;
        }
    
        foreach($paths as &$path){
          $path = $path . $suffix;
        }
    
        return $paths;
      }
}