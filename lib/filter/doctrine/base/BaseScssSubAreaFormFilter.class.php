<?php

/**
 * ScssSubArea filter form base class.
 *
 * @package    scss
 * @subpackage filter
 * @author     David Durost
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseScssSubAreaFormFilter extends ScssAreaFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('scss_sub_area_filters[%s]');
  }

  public function getModelName()
  {
    return 'ScssSubArea';
  }
}
