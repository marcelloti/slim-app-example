<?php
namespace SlimExample\Modules\Core\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateApiDocCommand extends Command {
  protected function configure(): void {
    $this
    ->setName('updateapidoc')
    ->setDescription('Update the API documentation file');
  }

  protected function execute(InputInterface $input, OutputInterface $output): int {
    exec('vendor/bin/openapi -o openapi.json src');
    
    echo PHP_EOL."Documentation updated".PHP_EOL.PHP_EOL;
    return Command::SUCCESS;
  }
}