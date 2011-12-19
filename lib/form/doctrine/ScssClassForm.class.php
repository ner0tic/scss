<?php

/**
 * ScssClass form.
 *
 * @package    scss
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ScssClassForm extends BaseScssClassForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at'],$this['slug']);

    $camp = $this->getOption('route')->getObject();


    $this->widgetSchema['course_id'] = new sfWidgetFormChoice(
      array(
        'choices' => $camp->getCourses()
    ));
  }
}
