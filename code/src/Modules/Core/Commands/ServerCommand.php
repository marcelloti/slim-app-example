<?php
namespace SlimExample\Modules\Core\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ServerCommand extends Command {
  protected function configure(): void {
    $this->setName('server')->setDescription('Run a PHP Built-in Server');
  }
  protected function execute(InputInterface $input, OutputInterface $output): void {
    $output->write('Run server in http://localhost:8080');

    exec('php -S localhost:8080 -t ' . getcwd() . DIRECTORY_SEPARATOR . "public");
  }
}