<?php

/**
 * Comment form base class.
 *
 * @method Comment getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCommentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'record_model'   => new sfWidgetFormInputText(),
      'record_id'      => new sfWidgetFormInputText(),
      'author_name'    => new sfWidgetFormInputText(),
      'author_email'   => new sfWidgetFormInputText(),
      'author_website' => new sfWidgetFormInputText(),
      'body'           => new sfWidgetFormTextarea(),
      'is_delete'      => new sfWidgetFormInputText(),
      'edition_reason' => new sfWidgetFormTextarea(),
      'reply'          => new sfWidgetFormInputText(),
      'user_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SfGuardUser'), 'add_empty' => true)),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'record_model'   => new sfValidatorString(array('max_length' => 255)),
      'record_id'      => new sfValidatorInteger(),
      'author_name'    => new sfValidatorString(array('max_length' => 255)),
      'author_email'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'author_website' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'body'           => new sfValidatorString(),
      'is_delete'      => new sfValidatorInteger(array('required' => false)),
      'edition_reason' => new sfValidatorString(array('required' => false)),
      'reply'          => new sfValidatorInteger(array('required' => false)),
      'user_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SfGuardUser'), 'required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comment';
  }

}
