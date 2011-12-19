<?php

/**
 * ScssCamp form base class.
 *
 * @method ScssCamp getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseScssCampForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'address_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Address'), 'add_empty' => false)),
      'district_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('District'), 'add_empty' => false)),
      'phone'       => new sfWidgetFormInputText(),
      'fax'         => new sfWidgetFormInputText(),
      'email'       => new sfWidgetFormInputText(),
      'url'         => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'slug'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 150)),
      'address_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Address'))),
      'district_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('District'))),
      'phone'       => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'fax'         => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'email'       => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'url'         => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'slug'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'ScssCamp', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('scss_camp[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ScssCamp';
  }

}
