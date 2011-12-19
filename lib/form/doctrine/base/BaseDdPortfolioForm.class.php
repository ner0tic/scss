<?php

/**
 * DdPortfolio form base class.
 *
 * @method DdPortfolio getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDdPortfolioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormTextarea(),
      'description' => new sfWidgetFormTextarea(),
      'image'       => new sfWidgetFormInputText(),
      'url'         => new sfWidgetFormTextarea(),
      'status_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DdStatus'), 'add_empty' => true)),
      'client_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DdClient'), 'add_empty' => true)),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'slug'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'        => new sfValidatorString(),
      'description' => new sfValidatorString(),
      'image'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'url'         => new sfValidatorString(),
      'status_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DdStatus'), 'required' => false)),
      'client_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DdClient'), 'required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'slug'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dd_portfolio[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DdPortfolio';
  }

}
