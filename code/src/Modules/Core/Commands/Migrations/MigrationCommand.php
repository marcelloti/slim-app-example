<?php

namespace SlimExample\Modules\Core\Commands\Migrations;

use Phinx\Console\Command\Migrate;

class MigrationCommand extends Migrate {
  protected function configure(): void {
    parent::configure();
    $this->setName('migration:run');
  }
}