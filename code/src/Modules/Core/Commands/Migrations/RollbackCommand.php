<?php

namespace SlimExample\Modules\Core\Commands\Migrations;

use Phinx\Console\Command\Rollback;

class RollbackCommand extends Rollback {
  protected function configure(){
    parent::configure();
    $this->setName('migration:rollback');
  }
}