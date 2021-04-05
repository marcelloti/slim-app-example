<?php
namespace SlimExample\Modules\Core\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class SubscriberCommand extends Command {
  protected function configure(): void {
    $this
    ->setName('subscriber')
    ->setDescription('Run a PHP subscriber')
    ->addArgument('moduleAndSubscriber', InputArgument::REQUIRED, 'Module and subscriber name');
  }

  protected function execute(InputInterface $input, OutputInterface $output): int {
    $moduleAndSubscriber = $input->getArgument('moduleAndSubscriber');
    $moduleName = explode("::", $moduleAndSubscriber)[0];
    $subscriberName = explode("::", $moduleAndSubscriber)[1];

    $subscriberPath = getcwd() . DIRECTORY_SEPARATOR .
                   "src" . DIRECTORY_SEPARATOR .
                   "Modules" . DIRECTORY_SEPARATOR .
                   $moduleName . DIRECTORY_SEPARATOR .
                   "Subscribers" . DIRECTORY_SEPARATOR .
                   $subscriberName . "Subscriber.php";


    if (!file_exists($subscriberPath)){
      throw new \Exception("File did not exist ".$subscriberPath);
    }

    require($subscriberPath);

    $subscriberClassName = "SlimExample\\Modules\\".$moduleName."\\Subscribers\\".$subscriberName."Subscriber";
    $subscriberObj = new $subscriberClassName();

    echo PHP_EOL;
    echo ">>".PHP_EOL;
    echo "Running Subscriber ".$subscriberClassName.PHP_EOL;
    echo ">>".PHP_EOL;
    echo PHP_EOL;

    $subscriberObj->execute();
    return Command::SUCCESS;
  }
}