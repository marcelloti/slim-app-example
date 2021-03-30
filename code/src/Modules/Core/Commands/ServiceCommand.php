<?php
namespace SlimExample\Modules\Core\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class ServiceCommand extends Command {
  protected function configure(){
    $this
    ->setName('service')
    ->setDescription('run a PHP service')
    ->addArgument('moduleAndService', InputArgument::REQUIRED, 'Module and service name');
  }

  protected function execute(InputInterface $input, OutputInterface $output): int {
    $moduleAndService = $input->getArgument('moduleAndService');
    $moduleName = explode("::", $moduleAndService)[0];
    $serviceName = explode("::", $moduleAndService)[1];

    $servicePath = getcwd() . DIRECTORY_SEPARATOR .
                   "src" . DIRECTORY_SEPARATOR .
                   "Modules" . DIRECTORY_SEPARATOR .
                   $moduleName . DIRECTORY_SEPARATOR .
                   "Services" . DIRECTORY_SEPARATOR .
                   $serviceName . "Service.php";


    if (!file_exists($servicePath)){
      throw new \Exception("File did not exist ".$servicePath);
    }

    require($servicePath);

    $serviceClassName = "SlimExample\\Modules\\".$moduleName."\\Services\\".$serviceName."Service";
    $serviceObj = new $serviceClassName();

    echo PHP_EOL;
    echo ">>".PHP_EOL;
    echo "Running Service ".$serviceClassName.PHP_EOL;
    echo ">>".PHP_EOL;
    echo PHP_EOL;

    $serviceObj->execute();
    return Command::SUCCESS;
  }
}