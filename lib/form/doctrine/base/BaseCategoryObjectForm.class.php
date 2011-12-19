<?php

/**
 * CategoryObject form base class.
 *
 * @method CategoryObject getObject() Returns the current form's model object
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCategoryObjectForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'category_id'       => new sfWidgetFormInputHidden(),
      'categorized_model' => new sfWidgetFormInputHidden(),
      'categorized_id'    => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'category_id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('category_id')), 'empty_value' => $this->getObject()->get('category_id'), 'required' => false)),
      'categorized_model' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('categorized_model')), 'empty_value' => $this->getObject()->get('categorized_model'), 'required' => false)),
      'categorized_id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('categorized_id')), 'empty_value' => $this->getObject()->get('categorized_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('category_object[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CategoryObject';
  }

}
