<?php

namespace Drupal\byu_resources\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class ByuResourcesController
 * @package Drupal\byu_resources\Controller
 * Creates the page where the BYU resources will be listed.
 */

class ByuResourcesController extends ControllerBase {

  /**
   * Function that builds all the content that is found in the BYU resources page.
   * @return array - Content of the page.
   */

  public function content() {
    $html = '<div id="resources">Resources loading...</div>';

    return [
      '#type' => 'markup',
      '#markup' => $this->t($html)
    ];
  }
}