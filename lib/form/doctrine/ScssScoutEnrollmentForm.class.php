<?php

/**
 * ScssScoutEnrollment form.
 *
 * @package    scss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ScssScoutEnrollmentForm extends BaseScssScoutEnrollmentForm
{
  public function configure()
  {
    unset($this['created_at'],$this['updated_at'], $this['scout_id']);

    $period = $this->getOption('period');
    $this->widgetSchema['class_id'] = new sfWidgetFormChoice(
      array(
        'choices'   =>  $period->getClasses(),
      ));
  }
}
