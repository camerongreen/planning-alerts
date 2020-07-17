<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatusController {

  /**
   * @Route("/")
   */
  public function status() {
    return new Response('Current status');
  }
}
