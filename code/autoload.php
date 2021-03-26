<?php

$composer = require __DIR__ . '/vendor/autoload.php';

$modules = path_modules();

foreach ($modules as &$module){
  $moduleName = substr($module, strpos($module, 'Modules')+8);
  $modulePath = substr($module, strpos($module, 'src'));
  $composer->setPsr4('SlimExample\\Modules\\'.$moduleName."\\", $module);
}

return $composer;