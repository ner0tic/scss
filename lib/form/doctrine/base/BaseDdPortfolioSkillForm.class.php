<?php

/**
 * DdPortfolioSkill form base class.
 *
 * @method DdPortfolioSkill getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDdPortfolioSkillForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'dd_portfolio_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DdPortfolio'), 'add_empty' => true)),
      'dd_skill_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DdSkill'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'dd_portfolio_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DdPortfolio'), 'required' => false)),
      'dd_skill_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DdSkill'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dd_portfolio_skill[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DdPortfolioSkill';
  }

}
