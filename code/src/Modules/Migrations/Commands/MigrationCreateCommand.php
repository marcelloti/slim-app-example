<?php

namespace SlimExample\Modules\Migrations\Commands;

use Phinx\Console\Command\Create;

class MigrationCreateCommand extends Create {
  protected function configure(){
    parent::configure();
    $this->setName('migration:create');
  }
}