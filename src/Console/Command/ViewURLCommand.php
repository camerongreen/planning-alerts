<?php

namespace App\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ViewURLCommand extends Command {

  protected function configure() {
    $this->setName('planning-alerts:view')
      ->setDescription('View the status of a Planning Alert endpoint')
      ->addArgument(
        'url',
        InputArgument::REQUIRED,
        'What URL are we parsing?'
      );
  }

  protected function execute(InputInterface $input, OutputInterface $output) {
    $url = $input->getArgument('url');

    $output->writeln($url);
  }

}
