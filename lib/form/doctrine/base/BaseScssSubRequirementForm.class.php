<?php

/**
 * ScssSubRequirement form base class.
 *
 * @method ScssSubRequirement getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseScssSubRequirementForm extends ScssRequirementForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('scss_sub_requirement[%s]');
  }

  public function getModelName()
  {
    return 'ScssSubRequirement';
  }

}
