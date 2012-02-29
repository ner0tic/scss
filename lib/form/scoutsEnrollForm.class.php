<?php
// lib/form/scoutsEnrollForm.class.php
    class ScoutsEnrollForm extends sfForm {
        public function configure() {
            $q = Doctrine_Core::getTable('ScssScout')->createQuery('s')->
                leftJoin('s.Patrol p')->
                where('p.troop_id = ?',sfContext::getInstance()->getUser()->getProfile()->getActiveEnrollment()->getTroop()->getId())->
                orderBy('s.last_name, s.first_name ASC');
            $this->widgetSchema['scout_id'] = new sfWidgetFormDoctrineChoice(
                array(
                    'model' => 'ScssScout',
                    'query' => $q
            ));

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
