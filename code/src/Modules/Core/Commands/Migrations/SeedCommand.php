<?php

namespace SlimExample\Modules\Core\Commands\Migrations;

use Phinx\Console\Command\SeedRun;

class SeedCommand extends SeedRun {
  protected function configure(): void {
    parent::configure();
    $this->setName('migration:seed:run');
  }
}