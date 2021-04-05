<?php

namespace SlimExample\Modules\Core\Commands\Migrations;

use Phinx\Console\Command\SeedCreate;

class SeedCreateCommand extends SeedCreate {
  protected function configure(): void {
    parent::configure();
    $this->setName('migration:seed:create');
  }
}