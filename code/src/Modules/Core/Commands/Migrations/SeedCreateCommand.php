<?php

namespace SlimExample\Modules\Core\Commands\Migrations;

use Phinx\Console\Command\SeedCreate;

class SeedCreateCommand extends SeedCreate {
  protected function configure(){
    parent::configure();
    $this->setName('migration:seed:create');
  }
}