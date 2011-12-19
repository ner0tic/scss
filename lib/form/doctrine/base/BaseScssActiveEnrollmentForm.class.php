<?php

/**
 * ScssActiveEnrollment form base class.
 *
 * @method ScssActiveEnrollment getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseScssActiveEnrollmentForm extends SfGuardUserProfileForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['troop_enrollment_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('troop_enrollment_id'), 'add_empty' => true));
    $this->validatorSchema['troop_enrollment_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('troop_enrollment_id'), 'required' => false));

    $this->widgetSchema->setNameFormat('scss_active_enrollment[%s]');
  }

  public function getModelName()
  {
    return 'ScssActiveEnrollment';
  }

}
