<?php

/**
 * ScssTroopEnrollmentTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ScssTroopEnrollmentTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ScssTroopEnrollmentTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ScssTroopEnrollment');
    }
    
    public function addActiveCampQuery(Doctrine_Query $q = null) {
      if(is_null($q)) $q = Doctrine_Query::create()->from('ScssTroopEnrollment te');
      $alias = $q->getRootAlias();
      $q->leftJoin($alias.'.Week w')->andWhere('w.camp_id = ?',sfContext::getInstance()->getUser()->getProfile()->getActiveEnrollment()->getWeek()->getCamp()->getId());
      return $q;
    }
    
    public function getBySeason($yr = null, Doctrine_Query $q = null) {
      if(is_null($yr))  $yr = date('Y');
      return $this->addActiveCampQuery($q)->andWhere("date_format('%Y',w.start_date) = ?",$yr)->execute();
    }
}