<?php
/**
 * Created by PhpStorm.
 * User: will
 * Date: 7/17/18
 * Time: 3:32 PM
 */

namespace Drupal\byu_resources\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class ByuResourcesController
 * @package Drupal\byu_resources\Controller
 * Creates the page where the BYU resources will be listed.
 */

class ByuResourcesController extends ControllerBase {
  public function content() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Hello World!')
    ];
  }
}