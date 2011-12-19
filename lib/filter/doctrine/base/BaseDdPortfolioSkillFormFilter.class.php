<?php

/**
 * DdPortfolioSkill filter form base class.
 *
 * @package    scss
 * @subpackage filter
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDdPortfolioSkillFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'dd_portfolio_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DdPortfolio'), 'add_empty' => true)),
      'dd_skill_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DdSkill'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'dd_portfolio_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DdPortfolio'), 'column' => 'id')),
      'dd_skill_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DdSkill'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('dd_portfolio_skill_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DdPortfolioSkill';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'dd_portfolio_id' => 'ForeignKey',
      'dd_skill_id'     => 'ForeignKey',
    );
  }
}
