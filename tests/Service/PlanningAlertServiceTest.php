<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\PlanningAlertService;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class PlanningAlertServiceTest extends TestCase {

  public function testSearchFieldsFoundFile(): void {
    $authority = 'rockhampton';

    $data = <<<EOT
[
    {
        "application": {
            "description": "2.4m high steel boundary fence"
        }
    },
    {
        "application": {
            "description": "High Impact Abbatoir and ERA 62"
        }
    },
    {
        "application": {
            "description": "Function Facility and Operational Works associated with an Advertising Device (Pylon Sign)"
        }
    }
]
EOT;

    $response = new MockResponse($data, []);

    $httpClient = new MockHttpClient([$response]);

    $pas = new PlanningAlertService('./config/planning-alerts.yaml', 'http://test.test', 'test', $httpClient);

    $result = $pas->checkAuthority($authority);

    self::assertCount(1, $result);
  }

  public function testSearchFieldsFound(): void {
    $keywords = [
      'one',
    ];

    $fields = [
      'desc',
    ];

    $data = [
      [
        'desc' => 'one',
      ],
      [
        'desc' => 'two',
      ],
      [
        'desc' => 'three',
      ],
      [
        'desc' => 'three one two',
      ],
    ];

    $httpClient = new MockHttpClient([]);

    $pas = new PlanningAlertService('test', 'test', 'test', $httpClient);

    $result = $pas->searchFields($fields, $keywords, $data);

    self::assertCount(2, $result);
  }

}
