<?php

namespace App\Console\Command;

use App\Service\PlanningAlertService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ViewURLCommand extends Command {

  private $alertService;

  public function __construct(PlanningAlertService $alertService) {
    $this->alertService = $alertService;
    parent::__construct();
  }

  protected function configure() {
    $this->setName('planning-alerts:view')
      ->setDescription('View the status of a Planning Alert authority')
      ->addArgument(
        'authority',
        InputArgument::REQUIRED,
        'What authority are we parsing?'
      );
  }

  protected function execute(InputInterface $input, OutputInterface $output) {
    $authority = $input->getArgument('authority');

    try {
      $results = $this->alertService->checkAuthority($authority);

      foreach ($results as $result) {
        $output->writeln(json_encode($result, TRUE));
      }

      return Command::SUCCESS;
    }
    catch (Exception $e) {
      return Command::FAILURE;
    }
  }

}
