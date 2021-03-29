<?php

namespace SlimExample\Modules\Core\Routing;

use Slim\App;

abstract class Route {
  protected $app;

  public function __construct(App $app){
    $this->app = $app;
  }

  abstract public function create();
}