<?php

namespace SlimExample\Modules\Migrations\Commands;

use Phinx\Console\Command\Rollback;

class RollbackCommand extends Rollback {
  protected function configure(){
    parent::configure();
    $this->setName('migration:rollback');
  }
}