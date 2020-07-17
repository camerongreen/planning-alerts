<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class PlanningAlertService {
  private $client;
  private $baseUrl;
  private $key;

  public function __construct(string $baseUrl, string $key, HttpClientInterface $client) {
    $this->client = $client;
    $this->baseUrl = $baseUrl;
    $this->key = $key;
  }

  public function parseAuthority(string $authority) {
    $url = sprintf('%s/authorities/%s/applications.js?key=%s', $this->baseUrl, $authority, $this->key);
    $response = $this->fetchAuthorityDetails($url);

    return [
      'name' => 'Things',
      'url' => $url,
      'response' => $response
    ];
  }

  public function fetchAuthorityDetails(string $url): string
  {
    $response = $this->client->request(
      'GET',
      $url
    );

    $statusCode = $response->getStatusCode();
    $content = $response->getContent();

    return $content;
  }


}
