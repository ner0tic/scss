<?php
  class troopEnrollmentComponents extends sfComponents {
    /**
     *
     * @param sfWebRequest $request 
     */
    public function executeRenderActiveTroopList(sfWebRequest $request) {
      $this->changes = array();
      // build season select :: always show
      $this->changes['season']                  = new sfWidgetFormDoctrineChoice(
              array(
                  'model'                       =>  'ScssWeek',
                  'query'                       =>  Doctrine::getTable('ScssWeek')
                      ->createQuery('w')
                      ->select('DISTINCT(date_format(w.start_date,/'%Y/'))')
                      ->orderBy('start_date DESC')
              ));
      // build troop select :: show if not troop_user level
      $this->changes['troop']                   = new sfWidgetFormDoctrineChoice(
              array(
                  'model'                       =>  'ScssTroopEnrollment',
                  'query'                       =>  Doctrine::getTable('ScssTroopEnrollment')
                      ->createQuery('e')
                      ->select('DISTINCT(e.troop_id as id), t.number as number, d.code as code')
                      ->leftJoin('e.Troop t')
                      ->leftJoin('t.District d')
              ));
      // build camp select :: show if troop is attending more then one camp per season
      $this->changes['camp']                    = new sfWidgetFormDoctrineChoice(
              array(
                  'model'                       =>  'ScssTroopEnrollment',
                  'query'                       =>  Doctrine::getTable('ScssTroopEnrollment')
                      ->createQuery('e')
                      ->filterByTroop($this->getUser()->getProfile()->getActiveEnrollment()->getTroop())
                      ->leftJoin('e.Week w')
                      ->leftJoin('w.Camp c')
                      ->select('c.id, c.name, e.week_id')
                      
              ));
      // build week select :: show if troop is attending more then one week per camp
      $this->changes['week']                    = new sfWidgetFormDoctrineChoice(
              array(
                  'model'                       =>  'ScssWeek',
                  'query'                       =>  Doctrine::getTable('ScssTroopEnrollment')
                      ->createQuery('e')
                      ->filterByCamp($this->getUser()->getProfile()->getActiveEnrollment()->getWeek()->getCamp())
                      ->select('DISTINCT(cw.id as id), cw.label as name')
              ));
      $this->troops                             = Doctrine::getTable('ScssTroopEnrollment')->createQuery()->filterBySeason();
      $this->currentEnrollment                  = array();
      $this->currentEnrollment['district_code'] = $this->getUser()->getProfile()->getActiveEnrollment()->getTroop()->getDistrict()->getCode();
      $this->currentEnrollment['troop_number']  = $this->getUser()->getProfile()->getActiveEnrollment()->getTroop()->getNumber();
      
      
    }
  }
?> 