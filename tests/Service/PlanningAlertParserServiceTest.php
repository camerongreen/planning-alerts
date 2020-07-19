<?php

namespace App\Tests\Service;

use App\Service\PlanningAlertParserService;
use PHPUnit\Framework\TestCase;
use App\Service\PlanningAlertRequestService;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class PlanningAlertParserServiceTest extends TestCase {

  public function testSearchFieldsFoundMockFile(): void {
    $authority = 'rockhampton';
    $data = file(__DIR__ . '/../test-data/output.json');
    $response = new MockResponse($data, []);
    $httpClient = new MockHttpClient([$response]);

    $pars = new PlanningAlertRequestService('http://test.test', 'test', $httpClient);
    $paps = new PlanningAlertParserService('./config/planning-alerts.yaml');
    $authorityData = $pars->getAuthorityData($authority);
    $result = $paps->checkAuthority($authorityData);

    self::assertCount(1, $result);
  }

}
