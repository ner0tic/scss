<?php

/**
 * ScssScoutEnrollment
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    scss
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class ScssScoutEnrollment extends BaseScssScoutEnrollment
{
  public function getClassSlug() { return $this->getClass()->getSlug();}
  public function getDistrictSlug() { return $this->getClass()->getPeriod()->getWeek()->getCamp()->getDistrict()->getSlug(); }
    public function getWeekSlug() { return $this->getClass()->getPeriod()->getWeek()->getSlug(); }
    public function getScoutSlug() { return $this->getScout()->getSlug(); }
  public function getCampSlug() { return $this->getClass()->getPeriod()->getWeek()->getCamp()->getSlug(); }
}
