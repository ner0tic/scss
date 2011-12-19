<?php

/**
 * ScssCourse form.
 *
 * @package    scss
 * @subpackage form
 * @author     David Durost <david.durost@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ScssCourseForm extends BaseScssCourseForm
{
  public function configure()
  {
	unset(
		$this['created_at'], $this['updated_at'], $this['slug']
	);
	if(sfContext::getInstance()->getUser()->getProfile()->getAccessLevel()<=SCSS::CAMP_ADMIN) {
		unset($this['camp_id']);
		$this['camp_id'] = sfContext::getInstance()->getUser()->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getId();
	}

	
  }
}
