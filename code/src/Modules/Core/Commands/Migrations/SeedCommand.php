<?php

namespace SlimExample\Modules\Core\Commands\Migrations;

use Phinx\Console\Command\SeedRun;

class SeedCommand extends SeedRun {
  protected function configure(){
    parent::configure();
    $this->setName('migration:seed:run');
  }
}