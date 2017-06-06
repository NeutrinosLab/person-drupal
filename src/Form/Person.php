<?php

namespace Drupal\ahmed_azab\Form;


use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormBase;
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
    return "ahmed_azab_settings_form";
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
    $config = $this->config('ahmed_azab.settings');
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your name'),
      '#description' => $this->t('Enter your name'),
      '#value' => $config->get('ahmed_azab.name'),
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#value' => $config->get('ahmed_azab.email'),
      '#description' => 'Entr your Email',
    ];

    $form['age'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Age'),
      '#value' => $config->get('ahmed_azab.age'),
      '#description' => 'Enter your Age',
    ];

    $form['gender'] = [
      '#type' => 'select',
      '#title' => $this->t('Gender'),
      '#value' => $config->get('ahmed_azab.gender'),
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
    $config = $this->config('ahmed_azab.settings');
    $input = $form_state->getUserInput();
    $config->set('ahmed_azab.name', $input['name']);
    $config->set('ahmed_azab.email', $input['email']);
    $config->set('ahmed_azab.age', $input['age']);
    $config->set('ahmed_azab.gender', $input['gender']);
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
      'ahmed_azab.settings',
    ];
  }

  public function getConf($name){
    $config = $this->config('ahmed_azab.settings');
    return $config->get('ahmed_azab.'.$name);
  }
}
