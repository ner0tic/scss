<?php

/**
 * DdClient form base class.
 *
 * @method DdClient getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDdClientForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'company_name' => new sfWidgetFormTextarea(),
      'first_name'   => new sfWidgetFormTextarea(),
      'last_name'    => new sfWidgetFormTextarea(),
      'email'        => new sfWidgetFormTextarea(),
      'phone'        => new sfWidgetFormTextarea(),
      'fax'          => new sfWidgetFormTextarea(),
      'url'          => new sfWidgetFormTextarea(),
      'address_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DdAddressBook'), 'add_empty' => true)),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
      'slug'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'company_name' => new sfValidatorString(),
      'first_name'   => new sfValidatorString(array('required' => false)),
      'last_name'    => new sfValidatorString(array('required' => false)),
      'email'        => new sfValidatorString(),
      'phone'        => new sfValidatorString(array('required' => false)),
      'fax'          => new sfValidatorString(array('required' => false)),
      'url'          => new sfValidatorString(array('required' => false)),
      'address_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DdAddressBook'), 'required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
      'slug'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dd_client[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DdClient';
  }

}
