<?php

/**
 * ScssScout form base class.
 *
 * @method ScssScout getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseScssScoutForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'first_name' => new sfWidgetFormInputText(),
      'last_name'  => new sfWidgetFormInputText(),
      'dob'        => new sfWidgetFormDateTime(),
      'patrol_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Patrol'), 'add_empty' => false)),
      'rank_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rank'), 'add_empty' => true)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
      'slug'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'first_name' => new sfValidatorString(array('max_length' => 60)),
      'last_name'  => new sfValidatorString(array('max_length' => 100)),
      'dob'        => new sfValidatorDateTime(),
      'patrol_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Patrol'))),
      'rank_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rank'), 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
      'slug'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'ScssScout', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('scss_scout[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ScssScout';
  }

}
