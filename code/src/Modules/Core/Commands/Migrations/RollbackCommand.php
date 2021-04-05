<?php

namespace SlimExample\Modules\Core\Commands\Migrations;

use Phinx\Console\Command\Rollback;

class RollbackCommand extends Rollback {
  protected function configure(): void {
    parent::configure();
    $this->setName('migration:rollback');
  }
}