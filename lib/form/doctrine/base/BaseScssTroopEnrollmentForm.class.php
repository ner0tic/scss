<?php

/**
 * ScssTroopEnrollment form base class.
 *
 * @method ScssTroopEnrollment getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseScssTroopEnrollmentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'troop_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Troop'), 'add_empty' => false)),
      'week_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Week'), 'add_empty' => true)),
      'site_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Campsite'), 'add_empty' => true)),
      'rotation_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rotation'), 'add_empty' => true)),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'troop_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Troop'))),
      'week_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Week'), 'required' => false)),
      'site_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Campsite'), 'required' => false)),
      'rotation_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rotation'), 'required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('scss_troop_enrollment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ScssTroopEnrollment';
  }

}
