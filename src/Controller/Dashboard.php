<?php

namespace Drupal\demomodule\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for dashboard output.
 */
class Dashboard extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function output() {

    $customblock = \Drupal::service('plugin.manager.block')->createInstance('demomodule_bootstrap_accordion_block',
        []);

    if (!$customblock) {
      return [];
    }
    return [
      '#type'           => 'container',
      '#attributes'     => [
        'class' => ["Myclass"],
      ],
      '#attached'       =>
      [
        'library' => ['demomodule/bootstrap4'],
      ],
      "element-content" => $customblock->build(),
      '#weight'         => 0,
    ];
  }

}
