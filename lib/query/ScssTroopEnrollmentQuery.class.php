<?php

/*
 * A custom query to add query filtering on the flye
 *
 * @author ner0tic
 */
class ScssTroopEnrollmentQuery extends Doctrine_Query {
  /**
   *
   * @param integer $year
   * @return Doctrine_Query $q 
   */
  public function filterBySeason($year = null) {
    if(is_null($year))  $year = date('Y');
    return $this->leftJoin($this->getRootAlias().'.Week w')->where("date_format('%Y',w.start_date) = ?",$year);      
  }

  /**
   *
   * @param $camp
   * @return Doctrine_Query $q 
   */
  public function filterByCamp($camp) {
    if(is_object($camp))  $id = $camp->getId();
    elseif(is_null($camp))  return null;
    else $id = $camp;
    return $this->leftJoin($this->getRootAlias().'.Week w')->where("w.camp_id = ?",$id);
  }

  /**
   *
   * @param $week
   * @return Doctrine_Query $q 
   */
  public function filterByWeek($week) {
    if(is_object($week))  $id = $week->getId();
    elseif(is_null($week))  return null;
    else $id = $week;
    return $this->where("w.id = ?",$id);
  }
}

?>
