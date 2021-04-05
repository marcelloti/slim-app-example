<?php

namespace SlimExample\Modules\Core\Commands\Migrations;

use Phinx\Console\Command\Init;

class InitCommand extends Init {
  protected function configure(): void {
    parent::configure();
    $this->setName('migration:init');
  }
}