<?php

namespace SlimExample\Modules\Migrations\Commands;

use Phinx\Console\Command\Status;

class StatusCommand extends Status {
  protected function configure(){
    parent::configure();
    $this->setName('migration:status');
  }
}