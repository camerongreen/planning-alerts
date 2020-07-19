<?php

namespace App\Service;

use Symfony\Component\Yaml\Yaml;

class PlanningAlertParserService {

  private $configFile;

  public function __construct(string $configFile) {
    $this->configFile = $configFile;
  }

  public function checkAuthority(array $details): array {
    $config = $this->parseConfiguration($this->configFile);
    return $this->searchFields($config['fields'], $config['keywords'], $details);
  }

  public function searchFields(array $fields, array $keywords, array $records): array {
    $returnVal = [];

    foreach ($records as $record) {
      foreach ($fields as $field) {
        if (isset($record[$field])) {
          $field_values = preg_split('/\W+/', strtolower($record[$field]));
          foreach ($keywords as $keyword) {
            if (in_array(strtolower($keyword), $field_values, TRUE)) {
              $record['match'] = $keyword;
              $returnVal[] = $record;
            }
          }
        }
      }
    }

    return $returnVal;
  }

  public function parseConfiguration(string $config_file): array {
    return Yaml::parseFile($config_file);
  }

}
