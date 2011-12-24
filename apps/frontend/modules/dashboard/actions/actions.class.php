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
  public function executeIndex(sfWebRequest $request) {
    $cur_pg['scout'] = $request->getParameter('s_page',1);
    $cur_pg['patrol'] = $request->getParameter('p_page',1);
    $max_pg = sfConfig::get('app_max_items_on_dashboard');
    // scouts
    $this->s_pager = new sfDoctrinePager('ScssScout',$max_pg);
    $this->s_pager->setQuery(Doctrine::getTable('ScssScout')->createQuery('a')->leftJoin('a.Patrol p')->where('p.troop_id = ?',$this->getUser()->getProfile()->getTroop()->getID())->orderBy('a.last_name, a.first_name ASC'));
    $this->s_pager->setPage($cur_pg['scout']);
    $this->s_pager->init();    
    // patrols
    $this->p_pager = new sfDoctrinePager('ScssPatrol',$max_pg);
    $this->p_pager->setQuery(Doctrine::getTable('ScssPatrol')->createQuery('p')->where('p.troop_id = ?',$this->getUser()->getProfile()->getTroop()->getID())->orderBy('p.name ASC'));
    $this->p_pager->setPage($cur_pg['patrol']);
    $this->p_pager->init();       
  }
  
  public function executeSetActiveEnrollment(sfWebRequest $request) {
    $this->redirect($this->getUser()->getHomeRoute());
  }
}
