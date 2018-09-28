<?php

namespace Drupal\byu_resources\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;


class ByuResourcesConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   * @return string
   */

  public function getFormId() {
    return 'byu_resources_settings';
  }

  /**
   * {@inheritdoc}
   * @return array
   */

  public function getEditableConfigNames()
  {
    return [
      'byu_resources.settings'
    ];
  }

  /**
   * {@inheritdoc}
   * @param array $form
   * @param FormStateInterface $formState
   * @return array
   */

  public function buildForm(array $form, FormStateInterface $formState = null) {
    $config = $this->config('byu_resources.settings');

    $defaults['my_textfield'] = $config->get('my_textfield');

    $form['my_textfield'] = [
      '#type' => 'textfield',
      '#title' => $this->t('This is a test.'),
      '#default_value' => isset($defaults['my_textfield']) ? $defaults['my_textfield'] : ''
    ];

    return parent::buildForm($form, $formState);
  }

  /**
   * {@inheritdoc}
   * @param array $form
   * @param FormStateInterface $formState
   */

  public function submitForm(array &$form, FormStateInterface $formState) {

    $this->configFactory->getEditable('byu_resources.settings')
      ->set('my_textfield', $formState->getValue('my_textfield'))
      ->save();

    parent::submitForm($form, $formState);
  }
}