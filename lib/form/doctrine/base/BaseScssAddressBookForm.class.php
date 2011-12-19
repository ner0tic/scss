<?php

/**
 * ScssAddressBook form base class.
 *
 * @method ScssAddressBook getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseScssAddressBookForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'label'       => new sfWidgetFormInputText(),
      'street'      => new sfWidgetFormInputText(),
      'suburb'      => new sfWidgetFormInputText(),
      'city'        => new sfWidgetFormInputText(),
      'zone_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zone'), 'add_empty' => false)),
      'postal_code' => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'label'       => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'street'      => new sfValidatorString(array('max_length' => 50)),
      'suburb'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'city'        => new sfValidatorString(array('max_length' => 30)),
      'zone_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Zone'))),
      'postal_code' => new sfValidatorString(array('max_length' => 10)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('scss_address_book[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ScssAddressBook';
  }

}
