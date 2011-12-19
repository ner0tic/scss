<?php

/**
 * ScssScoutEnrollment form base class.
 *
 * @method ScssScoutEnrollment getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseScssScoutEnrollmentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'scout_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Scout'), 'add_empty' => false)),
      'class_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Class'), 'add_empty' => false)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'scout_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Scout'))),
      'class_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Class'))),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('scss_scout_enrollment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ScssScoutEnrollment';
  }

}
