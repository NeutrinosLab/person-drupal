<?php

namespace Drupal\ahmed_azab\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Person' block.
 *
 * @Block(
 *   id = "ahmed_azab_block",
 *   admin_label = @Translation("Person: Block")
 * )
 */
class PersonBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = \Drupal::config('ahmed_azab.settings');
    $gender = ($config->get('ahmed_azab.gender') == 'm')?'Male':'Female';
    return array(
      '#type' => 'markup',
      '#markup' => "
        <p><strong>Name: </strong> ".$config->get('ahmed_azab.name')."</p>
        <p><strong>Email: </strong> ".$config->get('ahmed_azab.email')."</p>
        <p><strong>Age: </strong> ".$config->get('ahmed_azab.age')."</p>
        <p><strong>Gender: </strong> ".$gender."</p>
      ",
    );
  }

}
