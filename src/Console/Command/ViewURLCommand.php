<?php

namespace App\Console\Command;

use App\Service\PlanningAlertParserService;
use App\Service\PlanningAlertRequestService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ViewURLCommand extends Command {

  private $requestService;
  private $parserService;

  public function __construct(PlanningAlertRequestService $requestService, PlanningAlertParserService $parserService) {
    $this->requestService = $requestService;
    $this->parserService = $parserService;
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
      $authorityData = $this->requestService->getAuthorityData($authority);
      $results = $this->parserService->checkAuthority($authorityData);

      foreach ($results as $result) {
        $output->writeln(json_encode($result, JSON_PRETTY_PRINT));
      }

      return Command::SUCCESS;
    }
    catch (Exception $e) {
      return Command::FAILURE;
    }
  }

}
