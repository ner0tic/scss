<?php

/**
 * ScssWeek form base class.
 *
 * @method ScssWeek getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseScssWeekForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'label'      => new sfWidgetFormInputText(),
      'start_date' => new sfWidgetFormDateTime(),
      'end_date'   => new sfWidgetFormDateTime(),
      'tte'        => new sfWidgetFormInputCheckbox(),
      'camp_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Camp'), 'add_empty' => false)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
      'slug'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'label'      => new sfValidatorString(array('max_length' => 50)),
      'start_date' => new sfValidatorDateTime(),
      'end_date'   => new sfValidatorDateTime(),
      'tte'        => new sfValidatorBoolean(array('required' => false)),
      'camp_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Camp'))),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
      'slug'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'ScssWeek', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('scss_week[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ScssWeek';
  }

}
