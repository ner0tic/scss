<?php // apps/frontend/modules/troop/actions/components.class.php
/**
 * 
 */
  class troopComponents extends sfComponents {
    /**
     *
     * @param sfWebRequest $request 
     */
    public function executeWidgetCurrentEnrollment(sfWebRequest $request) {
      //$this->checks_c = Doctrine::getTable('ScssTroopEnrollment')->createQuery()->filterBySeason(date('y')+1)->filterByCamp($this->getUser()->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getId(), $this->getUser()->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getId())->execute();
      //$this->checks_w = false;//(bool)Doctrine::getTable('ScssTroopEnrollment')->createQuery()->filterBySeason(date('y')+1)->filterByCamp()->filterByWeek($this->getUser()->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getId(), $this->getUser()->getProfile()->getActiveEnrollment()->getWeek()->getSlug())->execute();
      $checks_s = Doctrine::getTable('ScssTroopEnrollment')->createQuery()->filterBySeason(date('y')+1)->filterByWeek($this->getUser()->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getId(), $this->getUser()->getProfile()->getActiveEnrollment()->getWeek()->getSlug())->filterByCampSite($this->getUser()->getProfile()->getActiveEnrollment()->getCampsite()->getId())->fetchOne();
      
      $this->cb_a = new ddWidgetFormInputToggle(array(),array('value'=>'checked'));
      $this->cb_s = new ddWidgetFormInputToggle(array(),array('value'=>($checks_s) ? 'checked' : null));
    }
    
    /**
     *
     * @param sfWebrequest $request 
     */
    public function executeWidgetFeeSvc(sfWebrequest $request) {
      // Widget :: feeSvcWidget
      // reservation counts
      //$this->enrollments['incomplete']  = Doctrine::getTable('ScssTroopEnrollment')->createQuery()->filterBySeason(date('Y')+1)->filterByRegistrationStatus(false)->execute;
      //$this->enrollments['complete']    = Doctrine::getTable('ScssTroopEnrollment')->createQuery()->filterBySeason(date('Y')+1)->filterByRegistrationStatus(true)->execute;
      $this->active_res = Doctrine::getTable('ScssTroopEnrollment')->createQuery('e')->select('count(*) as count')->filterBySeason()->filterByTroop($this->getUser()->getProfile()->getActiveEnrollment()->getTroopId())->fetchOne();
      $this->complete_res = 0;
    }
    
    /**
     *
     * @param sfWebRequest $request 
     */
    public function executeWidgetLeaderList(sfWebRequest $request) {
      // leader list
      
      // autocomplete form
      
      // add form
      $this->form = new TroopLeaderForm();           
    }
    
    /**
     *
     * @param sfWebRequest $request 
     */
    public function executeWidgetTroopDetails(sfWebRequest $request) {
      // Widget :: troop details
      // build form
      //$this->form = new TroopDetailForm($this->getUser()->getProfile()->getActiveEnrollment()->getTroop()->getId());
    }
  }
?> 