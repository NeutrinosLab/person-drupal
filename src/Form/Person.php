<?php

namespace Drupal\person_drupal\Form;


use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class Person extends ConfigFormBase
{

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId()
  {
    return "person_drupal_settings_form";
  }

  /**
   * Form constructor.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   The form structure.
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $config = $this->config('person_drupal.settings');
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your name'),
      '#description' => $this->t('Enter your name'),
      '#value' => $config->get('person_drupal.name'),
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#value' => $config->get('person_drupal.email'),
      '#description' => 'Entr your Email',
    ];

    $form['age'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Age'),
      '#value' => $config->get('person_drupal.age'),
      '#description' => 'Enter your Age',
    ];

    $form['gender'] = [
      '#type' => 'select',
      '#title' => $this->t('Gender'),
      '#value' => $config->get('person_drupal.gender'),
      '#options' => [
        'm' => $this->t('Male'),
        'f' => $this->t('Female'),
      ],
      '#empty_option' => $this->t('-select-'),
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),

    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    $input = $form_state->getUserInput();
    if (strlen($input['name']) < 4){
      return $form_state->setErrorByName('title', $this->t('The title must be at least 4 characters long.'));
    }
    if (!is_numeric($input['age'])){
      return $form_state->setErrorByName('title', $this->t('Age is must be a numeric number'));
    }
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $config = $this->config('person_drupal.settings');
    $input = $form_state->getUserInput();
    $config->set('person_drupal.name', $input['name']);
    $config->set('person_drupal.email', $input['email']);
    $config->set('person_drupal.age', $input['age']);
    $config->set('person_drupal.gender', $input['gender']);
    $config->save();
    drupal_set_message("Your configurations has been set successfully");
  }

  /**
   * Gets the configuration names that will be editable.
   *
   * @return array
   *   An array of configuration object names that are editable if called in
   *   conjunction with the trait's config() method.
   */
  protected function getEditableConfigNames()
  {
    return [
      'person_drupal.settings',
    ];
  }

  public function getConf($name){
    $config = $this->config('person_drupal.settings');
    return $config->get('person_drupal.'.$name);
  }
}
