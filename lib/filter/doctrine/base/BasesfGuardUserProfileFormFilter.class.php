<?php

/**
 * sfGuardUserProfile filter form base class.
 *
 * @package    scss
 * @subpackage filter
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserProfileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'access_level'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'troop_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Troop'), 'add_empty' => true)),
      'avatar'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'first_name'      => new sfWidgetFormFilterInput(),
      'last_name'       => new sfWidgetFormFilterInput(),
      'facebook_uid'    => new sfWidgetFormFilterInput(),
      'email'           => new sfWidgetFormFilterInput(),
      'email_hash'      => new sfWidgetFormFilterInput(),
      'active_troop_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ActiveTroop'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'user_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'access_level'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'troop_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Troop'), 'column' => 'id')),
      'avatar'          => new sfValidatorPass(array('required' => false)),
      'first_name'      => new sfValidatorPass(array('required' => false)),
      'last_name'       => new sfValidatorPass(array('required' => false)),
      'facebook_uid'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'email'           => new sfValidatorPass(array('required' => false)),
      'email_hash'      => new sfValidatorPass(array('required' => false)),
      'active_troop_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ActiveTroop'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'user_id'         => 'ForeignKey',
      'access_level'    => 'Number',
      'troop_id'        => 'ForeignKey',
      'avatar'          => 'Text',
      'first_name'      => 'Text',
      'last_name'       => 'Text',
      'facebook_uid'    => 'Number',
      'email'           => 'Text',
      'email_hash'      => 'Text',
      'active_troop_id' => 'ForeignKey',
    );
  }
}
