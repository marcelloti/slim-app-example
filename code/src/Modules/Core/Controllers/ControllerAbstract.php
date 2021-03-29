<?php
namespace SlimExample\Modules\Core\Controllers;

use Slim\Container;

abstract class ControllerAbstract {
  protected $container;

  public __construct(Container $container){
    $this->container = $container;
  }
}