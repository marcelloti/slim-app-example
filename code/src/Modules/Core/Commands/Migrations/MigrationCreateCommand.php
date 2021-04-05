<?php

namespace SlimExample\Modules\Core\Commands\Migrations;

use Phinx\Console\Command\Create;

class MigrationCreateCommand extends Create {
  protected function configure(): void {
    parent::configure();
    $this->setName('migration:create');
  }
}