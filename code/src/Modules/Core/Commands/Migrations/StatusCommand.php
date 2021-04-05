<?php

namespace SlimExample\Modules\Core\Commands\Migrations;

use Phinx\Console\Command\Status;

class StatusCommand extends Status {
  protected function configure(): void {
    parent::configure();
    $this->setName('migration:status');
  }
}