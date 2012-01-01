<?php

/*
 * A custom query to add query filtering on the flye
 *
 * @author ner0tic
 */
class ScssClassQuery extends Doctrine_Query {
  /**
   *
   * @param $year
   * @return Doctrine_Query
   */
  public function filterBySeason($year = null) {
    if(is_null($year))  $year = date('Y');
    return $this->leftJoin($this->getRootAlias().'.Period cp')->leftJoin('cp.Week cpw')->andWhere("date_format('%Y', cpw.start_date) = ?", $year);
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
    return $this->leftJoin($this->getRootAlias().'.Period pd')->andWhere('pd.week_id = ?', $id);   
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
    return $this->leftJoin($this->getRootAlias().'.Course cr')->andWhere('cr.camp_id = ?', $id);   
  }
  
  /**
   *
   * @param $staff
   * @return Doctrine_Query
   */
  public function filterByStaff($staff) {
    if(is_object($staff))  $id = $staff->getId();
    elseif(is_null($staff))  return null;
    else $id = $staff;
    return $this->andWhere($this->getRootAlias().'.staff_id = ?', $id);   
  }
  
  /**
   *
   * @param $mb
   * @return Doctrine_Query 
   */
  public function filterByMeritBadge($mb) {
    if(is_object($mb))  $id = $mb->getId();
    elseif(is_null($mb))  return null;
    else $id = $mb;
    return $this->leftJoin($this->getRootAlias().'.course cr')->andWhere('cr.meritbadge_id = ?', $id);   
  }
}

?>