<?php

namespace App\Service;

use Symfony\Component\Yaml\Yaml;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PlanningAlertService {

  private $client;

  private $configFile;

  private $baseUrl;

  private $key;

  public function __construct(string $configFile, string $baseUrl, string $key, HttpClientInterface $client) {
    $this->configFile = $configFile;
    $this->baseUrl = $baseUrl;
    $this->key = $key;
    $this->client = $client;
  }

  public function checkAuthority(string $authority): array {
    $config = $this->parseConfiguration($this->configFile);
    $details = $this->parseAuthority($authority);

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

  public function parseAuthority(string $authority): array {
    $url = sprintf('%s/authorities/%s/applications.js?key=%s', $this->baseUrl, $authority, $this->key);
    $json = json_decode($this->fetchAuthorityDetails($url), TRUE);
    return array_column($json, 'application');
  }

  public function parseConfiguration(string $config_file): array {
    return Yaml::parseFile($config_file);
  }

  public function fetchAuthorityDetails(string $url): string {
    $response = $this->client->request(
      'GET',
      $url
    );

    $statusCode = $response->getStatusCode();
    $content = $response->getContent();

    return $content;
  }


}
