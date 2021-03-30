<?php

$composer = require __DIR__ . '/vendor/autoload.php';

$modules = path_modules();
$libs = path_libs();

foreach ($modules as &$module){
  $moduleName = substr($module, strpos($module, 'Modules')+8);
  $composer->setPsr4('SlimExample\\Modules\\'.$moduleName."\\", $module);
}


foreach ($libs as &$lib){
  $libName = substr($lib, strpos($lib, 'Lib')+4);
  $composer->setPsr4('SlimExample\\Lib\\'.$libName."\\", $lib);
}

return $composer;