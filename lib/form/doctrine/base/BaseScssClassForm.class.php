<?php

/**
 * ScssClass form base class.
 *
 * @method ScssClass getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseScssClassForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'course_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Course'), 'add_empty' => false)),
      'area_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Area'), 'add_empty' => false)),
      'period_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Period'), 'add_empty' => false)),
      'staff_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Staff'), 'add_empty' => true)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'course_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Course'))),
      'area_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Area'))),
      'period_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Period'))),
      'staff_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Staff'), 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('scss_class[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ScssClass';
  }

}
