<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\PlanningAlertRequestService;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class PlanningAlertRequestServiceTest extends TestCase {

  public function testGetAuthorityData(): void {
    $authority = 'rockhampton';
    $data = file(__DIR__ . '/../test-data/output.json');
    $response = new MockResponse($data, []);
    $httpClient = new MockHttpClient([$response]);

    $pars = new PlanningAlertRequestService('http://test.test', 'test', $httpClient);
    $authorityData = $pars->getAuthorityData($authority);

    self::assertCount(3, $authorityData);
  }

}
