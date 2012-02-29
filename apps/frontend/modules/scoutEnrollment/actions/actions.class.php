<?php

/**
 * scoutEnrollment actions.
 *
 * @package    scss
 * @subpackage scoutEnrollment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class scoutEnrollmentActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $this->p_forms = '';
    foreach($this->getUser()->getProfile()->getActiveEnrollment()->getWeek()->getPeriods() as $period) {
        $this->p_forms[] = new classEnrollForm();//$period->getId());
    }
    if(!$request->hasParameter('scout_id')) $this->scout = new scoutsByTroopForm();//$this->getUser()->getProfile()->getTroop()->getId());
    else {
        $scout = new ScssScout($request->getParameter('scout_id'));
        $this->scout = $scout->getFirstName().' '.$scout->getLastName();
    }
  }
  public function executeNew(sfWebRequest $request) {
      $this->form = new ScoutEnrollForm(null,array('scout_slug' => $request->getParameter('scout_slug', null)));

  }
  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new ScssScoutEnrollment();
    $this->processForm($request, $this->form);
    $this->setTemplate('new');
  }
}
