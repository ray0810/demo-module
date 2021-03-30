<?php

namespace Drupal\demomodule\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a block with bootstrap accordion.
 *
 * @Block(
 *   id = "demomodule_bootstrap_accordion_block",
 *   admin_label = @Translation("Bootstrap accordion demo block"),
 *   provider = "user",
 *   category = @Translation("Demo")
 * )
 *
 * Note that we set module to contact so that blocks will be disabled correctly
 * when the module is disabled.
 */
class DemomoduleBootstrapAccordionBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Constructs a new DemomoduleBootstrapAccordionBlock plugin.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   */
  final public function __construct(array $configuration,
      $plugin_id,
      $plugin_definition) {
    parent::__construct(
        $configuration,
        $plugin_id,
        $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container,
      array $configuration,
      $plugin_id,
      $plugin_definition) {
    return new static(
        $configuration,
        $plugin_id,
        $plugin_definition
    );
  }

  /**
   * Implements \Drupal\block\BlockBase::build().
   */
  public function build() {

    $header_base = 'Accordion Item';
    $lorem_ipsum = 'Lorem Ipsum is simply dummy text of the printing';

    $accordion_elements = [];
    for ($i = 1; $i < 5; $i++) {
      $accordion_elements[] = [
        'title'    => $header_base . ' ' . $i,
        'content'  => $lorem_ipsum,
        'id'       => 'accItem' . $i,
        'expanded' => $i == 1 ? 'true' : 'false',
      ];
    }

    $block_data = [
      '#theme'              => 'bootstrap_accordion_block',
      '#accordion_elements' => $accordion_elements,
    ];

    return $block_data;
  }

}
