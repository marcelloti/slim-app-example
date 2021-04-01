<?php

namespace SlimExample\Modules\Core\Commands\Migrations;

use Phinx\Console\Command\Init;

class InitCommand extends Init {
  protected function configure(){
    parent::configure();
    $this->setName('migration:init');
  }
}