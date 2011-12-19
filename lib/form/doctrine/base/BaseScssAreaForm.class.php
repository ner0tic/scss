<?php

/**
 * ScssArea form base class.
 *
 * @method ScssArea getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseScssAreaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormInputText(),
      'parent_id'  => new sfWidgetFormInputText(),
      'camp_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Camp'), 'add_empty' => false)),
      'staff_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Staff'), 'add_empty' => true)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
      'slug'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 150)),
      'parent_id'  => new sfValidatorInteger(array('required' => false)),
      'camp_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Camp'))),
      'staff_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Staff'), 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
      'slug'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'ScssArea', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('scss_area[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ScssArea';
  }

}
