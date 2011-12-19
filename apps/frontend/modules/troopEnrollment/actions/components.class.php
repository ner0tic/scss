<?php
  class troopEnrollmentComponents extends sfComponents {
    public function executeRenderActiveTroopList(sfWebRequest $request) {
      $this->troops = Doctrine::getTable('ScssTroopEnrollment')->getBySeason();
      $this->currentEnrollment = array();
      $this->currentEnrollment['district_code'] = $this->getUser()->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getCode();
      $this->currentEnrollment['troop_number'] = $this->getUser()->getProfile()->getActiveEnrollment()->getTroop()->getNumber();
      sfConfig::set('web_debug',true);
    }
  }
?> 