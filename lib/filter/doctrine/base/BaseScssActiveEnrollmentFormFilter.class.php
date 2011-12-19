<?php

/**
 * ScssActiveEnrollment filter form base class.
 *
 * @package    scss
 * @subpackage filter
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseScssActiveEnrollmentFormFilter extends SfGuardUserProfileFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['troop_enrollment_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('troop_enrollment_id'), 'add_empty' => true));
    $this->validatorSchema['troop_enrollment_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('troop_enrollment_id'), 'column' => 'id'));

    $this->widgetSchema->setNameFormat('scss_active_enrollment_filters[%s]');
  }

  public function getModelName()
  {
    return 'ScssActiveEnrollment';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'troop_enrollment_id' => 'ForeignKey',
    ));
  }
}
