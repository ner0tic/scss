<?php

/**
 * DdAddressBook form base class.
 *
 * @method DdAddressBook getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDdAddressBookForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormTextarea(),
      'street'      => new sfWidgetFormTextarea(),
      'suburb'      => new sfWidgetFormTextarea(),
      'city'        => new sfWidgetFormTextarea(),
      'zone'        => new sfWidgetFormTextarea(),
      'country'     => new sfWidgetFormInputText(),
      'postal_code' => new sfWidgetFormTextarea(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'latitude'    => new sfWidgetFormInputText(),
      'longitude'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'        => new sfValidatorString(array('required' => false)),
      'street'      => new sfValidatorString(),
      'suburb'      => new sfValidatorString(array('required' => false)),
      'city'        => new sfValidatorString(),
      'zone'        => new sfValidatorString(),
      'country'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'postal_code' => new sfValidatorString(),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'latitude'    => new sfValidatorNumber(array('required' => false)),
      'longitude'   => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dd_address_book[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DdAddressBook';
  }

}
