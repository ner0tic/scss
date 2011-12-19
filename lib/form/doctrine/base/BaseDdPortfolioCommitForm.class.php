<?php

/**
 * DdPortfolioCommit form base class.
 *
 * @method DdPortfolioCommit getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDdPortfolioCommitForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'commit_msg'   => new sfWidgetFormTextarea(),
      'portfolio_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DdPortfolio'), 'add_empty' => true)),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'commit_msg'   => new sfValidatorString(),
      'portfolio_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DdPortfolio'), 'required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('dd_portfolio_commit[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DdPortfolioCommit';
  }

}
