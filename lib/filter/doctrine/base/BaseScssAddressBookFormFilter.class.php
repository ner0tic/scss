<?php

/**
 * ScssAddressBook filter form base class.
 *
 * @package    scss
 * @subpackage filter
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseScssAddressBookFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'label'       => new sfWidgetFormFilterInput(),
      'street'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'suburb'      => new sfWidgetFormFilterInput(),
      'city'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'zone_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zone'), 'add_empty' => true)),
      'postal_code' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'label'       => new sfValidatorPass(array('required' => false)),
      'street'      => new sfValidatorPass(array('required' => false)),
      'suburb'      => new sfValidatorPass(array('required' => false)),
      'city'        => new sfValidatorPass(array('required' => false)),
      'zone_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Zone'), 'column' => 'id')),
      'postal_code' => new sfValidatorPass(array('required' => false)),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('scss_address_book_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ScssAddressBook';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'label'       => 'Text',
      'street'      => 'Text',
      'suburb'      => 'Text',
      'city'        => 'Text',
      'zone_id'     => 'ForeignKey',
      'postal_code' => 'Text',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}
