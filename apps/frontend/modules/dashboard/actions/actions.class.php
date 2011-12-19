<?php

/**
 * dashboard actions.
 *
 * @package    scss
 * @subpackage dashboard
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dashboardActions extends sfActions
{
  public function executeConnectFb(sfWebRequest $request) {
    $this->getUser()->connect('facebook');
  }
  public function executeFacebook(sfWebRequest $request) {
    $this->me = $this->getUser()->getMelody('facebook')->getMe();
  }

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    // scouts
      $q = Doctrine_Query::create()
        ->from('ScssScout s')
        ->leftJoin('s.Patrol p')
        ->where('p.troop_id = ?',$this->getUser()->getProfile()->getTroop()->getID());
   
      $this->scouts = $q/*->addEnrolledQuery($this->getUSer->getProfile()->getActiveEnrollment()->getWeek()->getId(),$q)*/->execute();

      // patrols
      $q = Doctrine_Query::create()
        ->from('ScssPatrol p')
        ->where('p.troop_id = ?',$this->getUser()->getProfile()->getTroop()->getID());

      $this->patrols = $q->execute();
  }
  
  public function executeSetActiveEnrollment(sfWebRequest $request) {
    $this->redirect($this->getUser()->getHomeRoute());
  }
}
