<?php

/**
 * sfGuardUserProfile form base class.
 *
 * @method sfGuardUserProfile getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserProfileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'user_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'access_level'    => new sfWidgetFormInputText(),
      'troop_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Troop'), 'add_empty' => true)),
      'avatar'          => new sfWidgetFormTextarea(),
      'first_name'      => new sfWidgetFormInputText(),
      'last_name'       => new sfWidgetFormInputText(),
      'facebook_uid'    => new sfWidgetFormInputText(),
      'email'           => new sfWidgetFormInputText(),
      'email_hash'      => new sfWidgetFormInputText(),
      'active_troop_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ActiveTroop'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'access_level'    => new sfValidatorInteger(array('required' => false)),
      'troop_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Troop'), 'required' => false)),
      'avatar'          => new sfValidatorString(array('required' => false)),
      'first_name'      => new sfValidatorPass(array('required' => false)),
      'last_name'       => new sfValidatorPass(array('required' => false)),
      'facebook_uid'    => new sfValidatorInteger(array('required' => false)),
      'email'           => new sfValidatorPass(array('required' => false)),
      'email_hash'      => new sfValidatorPass(array('required' => false)),
      'active_troop_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ActiveTroop'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

}
