<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatusController extends AbstractController {

  /**
   * @Route("/")
   */
  public function status() {
    return $this->render('status/status.html.twig', [
        'statuses' => [
          'This is the status',
          'This is the status 2'
        ]
    ]);
  }
}
