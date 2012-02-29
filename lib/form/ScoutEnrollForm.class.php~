<?php
// lib/form/scoutEnrollForm.class.php
  class ScoutEnrollForm extends sfForm {
    public function configure() {
      $troop = sfContext::getInstance()->getUser()->getProfile()->getActiveEnrollment()->getTroop();
      $query = Doctrine::getTable('ScssScout')->createQuery('a')->filterByTroop($troop);
      $this->setWidget('scout_id', new sfWidgetFormDoctrineChoice(
              array(
                'model' => 'ScssScout',
                'query' => $query
              )));
      $scout = new ScssScout();
      $sForm = new sfForm();
      $pMax = sfContext::getInstance()->getUser()->getProfile()->getActiveEnrollment()->getWeek()->getPeriods();
      foreach($pMax as $i => $period) {
        $enroll = new ScssScoutEnrollment();
        $enroll->Scout = $scout;

        $form = new ScssScoutEnrollmentForm($enroll,array('period'=>$period));
        $sForm->embedForm($i,$form);
      }
      $this->embedForm('ClassesByPeriod',$sForm);
    }
  }
