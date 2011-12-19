<?php

/**
 * ScssTroopEnrollment filter form base class.
 *
 * @package    scss
 * @subpackage filter
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseScssTroopEnrollmentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'troop_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Troop'), 'add_empty' => true)),
      'week_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Week'), 'add_empty' => true)),
      'site_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Campsite'), 'add_empty' => true)),
      'rotation_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rotation'), 'add_empty' => true)),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'troop_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Troop'), 'column' => 'id')),
      'week_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Week'), 'column' => 'id')),
      'site_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Campsite'), 'column' => 'id')),
      'rotation_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rotation'), 'column' => 'id')),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('scss_troop_enrollment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ScssTroopEnrollment';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'troop_id'    => 'ForeignKey',
      'week_id'     => 'ForeignKey',
      'site_id'     => 'ForeignKey',
      'rotation_id' => 'ForeignKey',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}
