<?php

namespace App\Service;

use Symfony\Component\Yaml\Yaml;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PlanningAlertRequestService {

  private $client;

  private $baseUrl;

  private $key;

  public function __construct(string $baseUrl, string $key, HttpClientInterface $client) {
    $this->baseUrl = $baseUrl;
    $this->key = $key;
    $this->client = $client;
  }

  public function getAuthorityData(string $authority): array {
    $url = sprintf('%s/authorities/%s/applications.js?key=%s', $this->baseUrl, $authority, $this->key);
    $json = json_decode($this->fetchAuthorityDetails($url), TRUE);
    return array_column($json, 'application');
  }

  public function fetchAuthorityDetails(string $url): string {
    $response = $this->client->request(
      'GET',
      $url
    );

    return $response->getContent();
  }

}
