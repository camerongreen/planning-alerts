#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';

use PlanningAlerts\Console\Command\ViewURLCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new ViewURLCommand());
$application->run();

