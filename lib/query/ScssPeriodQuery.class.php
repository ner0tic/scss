<?php

/*
 * A custom query to add query filtering on the flye
 *
 * @author ner0tic
 */
class ScssPeriodQuery extends Doctrine_Query {
  /**
   *
   * @param $year
   * @return Doctrine_Query
   */
  public function filterBySeason($year = null) {
    if(is_null($year))  $year = date('Y');
    return $this->leftJoin($this->getRootAlias().'.week pw')->andWhere("date_format('%Y', pw.start_date) = ?", $year);
  }
  
  /**
   *
   * @param $week
   * @return Doctrine_Query
   */
  public function filterByWeek($week) {
    if(is_object($week))  $id = $week->getId();
    elseif(is_null($week))  return null;
    else $id = $week;
    return $this->andWhere($this->getRootAlias().'.week_id = ?', $id);   
  }
  
  /**
   *
   * @param $camp
   * @return Doctrine_Query
   */
  public function filterByCamp($camp) {
    if(is_object($camp))  $id = $camp->getId();
    elseif(is_null($camp))  return null;
    else $id = $camp;
    return $this->leftJoin($this->getRootAlias().'.Week pw')->andWhere('pw.camp_id = ?', $id);   
  }
}
?>