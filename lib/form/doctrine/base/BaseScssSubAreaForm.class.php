<?php

/**
 * ScssSubArea form base class.
 *
 * @method ScssSubArea getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseScssSubAreaForm extends ScssAreaForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('scss_sub_area[%s]');
  }

  public function getModelName()
  {
    return 'ScssSubArea';
  }

}
