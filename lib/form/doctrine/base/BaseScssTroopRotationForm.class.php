<?php

/**
 * ScssTroopRotation form base class.
 *
 * @method ScssTroopRotation getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseScssTroopRotationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormTextarea(),
      'description' => new sfWidgetFormTextarea(),
      'week_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Week'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'        => new sfValidatorString(),
      'description' => new sfValidatorString(array('required' => false)),
      'week_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Week'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('scss_troop_rotation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ScssTroopRotation';
  }

}
