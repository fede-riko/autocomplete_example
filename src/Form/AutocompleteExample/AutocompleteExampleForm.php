<?php

namespace Drupal\autocomplete_example\Form\AutocompleteExample;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides autocomplete example form.
 */
class AutocompleteExampleForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return "autocomplete_example_form";
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // autocomplete
    $form['city'] = [
      '#prefix' => '<div id="city">',
      '#suffix' => '</div>',
      '#type' => 'textfield',
      '#autocomplete_route_name' => 'autocomplete_example.autocomplete_cities',
      '#title' => $this->t('Zip code, City'),
    ];
    return $form;
  }

   /**
   * {@inheritdoc}
   */
  function validateForm(array &$form, FormStateInterface $form_state) {
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {}

}
