<?php

namespace SlimExample\Modules\Migrations\Commands;

use Phinx\Console\Command\Init;

class InitCommand extends Init {
  protected function configure(){
    parent::configure();
    $this->setName('migration:init');
  }
}