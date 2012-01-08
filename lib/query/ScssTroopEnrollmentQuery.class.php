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
   * @return Doctrine_Query
   */
  public function filterBySeason($year = null) {
    if(is_null($year))  $year = date('Y');
    return $this->leftJoin($this->getRootAlias().'.Week ww')->andWhere("date_format('%Y', ww.start_date) = ?",$year);      
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
    return $this->leftJoin($this->getRootAlias().'.Week cw')->andWhere("cw.camp_id = ?",$id);
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
    return $this->andWhere($this->getRootAlias().".id = ?",$id);
  }
  
  /**
   *
   * @param $site
   * @return Doctrine_Query
   */
  public function filterByCampSite($site) {
    if(is_object($site))  $id = $site->getId();
    elseif(is_null($site))  return null;
    else $id = $site;
    return $this->andWhere($this->getRootAlias().".id = ?", $id);
  }
  
  /**
   *
   * @param $troop
   * @return Doctrine_Query
   */
  public function filterByTroop($troop) {
    if(is_object($troop)) $id = $troop->getId();
    elseif(is_null($troop)) return null;
    else  $id = $troop;
    return $this->andWhere($this->getRootAlias().'.troop_id = ?', $id);
  }
  
}

?>
