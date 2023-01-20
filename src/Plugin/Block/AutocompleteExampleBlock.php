<?php

/**
 * @file
 * Contains \Drupal\autocomplete_example\Plugin\Block\AutocompleteExampleBlock.
 */

namespace Drupal\autocomplete_example\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormBuilder;

/**
 * Provides the Autocomplete Example block.
 *
 * @Block(
 *   id = "autocomplete_example",
 *   admin_label = @Translation("Block Autocomplete Example")
 * )
 */
class AutocompleteExampleBlock extends BlockBase implements ContainerFactoryPluginInterface {

  protected FormBuilder $formBuilder;

  /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param FormBuilder $formBuilder
   */
  public function __construct(
    array $configuration, $plugin_id, $plugin_definition,
    FormBuilder $formBuilder
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->formBuilder = $formBuilder;
  }

  /**
   * @param ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   *
   * @return static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('form_builder')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = $this->formBuilder?->getForm(\Drupal\autocomplete_example\Form\AutocompleteExample\AutocompleteExampleForm::class);
    return $form ?? [];
  }

}
