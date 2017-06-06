<?php

namespace Drupal\person_drupal\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Person' block.
 *
 * @Block(
 *   id = "person_drupal_block",
 *   admin_label = @Translation("Person: Block")
 * )
 */
class PersonBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = \Drupal::config('person_drupal.settings');
    $gender = ($config->get('person_drupal.gender') == 'm')?'Male':'Female';
    return array(
      '#type' => 'markup',
      '#markup' => "
        <p><strong>Name: </strong> ".$config->get('person_drupal.name')."</p>
        <p><strong>Email: </strong> ".$config->get('person_drupal.email')."</p>
        <p><strong>Age: </strong> ".$config->get('person_drupal.age')."</p>
        <p><strong>Gender: </strong> ".$gender."</p>
      ",
    );
  }

}
