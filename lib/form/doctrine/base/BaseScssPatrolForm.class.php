<?php

/**
 * ScssPatrol form base class.
 *
 * @method ScssPatrol getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseScssPatrolForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormInputText(),
      'img'        => new sfWidgetFormInputText(),
      'color'      => new sfWidgetFormInputText(),
      'troop_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Troop'), 'add_empty' => false)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
      'slug'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 60)),
      'img'        => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'color'      => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'troop_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Troop'))),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
      'slug'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'ScssPatrol', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('scss_patrol[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ScssPatrol';
  }

}
