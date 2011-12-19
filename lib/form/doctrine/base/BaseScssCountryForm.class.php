<?php

/**
 * ScssCountry form base class.
 *
 * @method ScssCountry getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseScssCountryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'name'              => new sfWidgetFormInputText(),
      'iso_code2'         => new sfWidgetFormInputText(),
      'iso_code3'         => new sfWidgetFormInputText(),
      'address_format_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AddressFormat'), 'add_empty' => false)),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'slug'              => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 64)),
      'iso_code2'         => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'iso_code3'         => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'address_format_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AddressFormat'))),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
      'slug'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'ScssCountry', 'column' => array('name'))),
        new sfValidatorDoctrineUnique(array('model' => 'ScssCountry', 'column' => array('iso_code2'))),
        new sfValidatorDoctrineUnique(array('model' => 'ScssCountry', 'column' => array('iso_code3'))),
        new sfValidatorDoctrineUnique(array('model' => 'ScssCountry', 'column' => array('slug'))),
      ))
    );

    $this->widgetSchema->setNameFormat('scss_country[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ScssCountry';
  }

}
